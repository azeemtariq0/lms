class Sidebar {
    constructor(options = {}) {
        this.$sidebarElement = $(options.sidebarElement || '#sidebar');
        this.$toggleElement = $(options.toggleElement || '#toggleSidebar');
        this.$mainContentElement = $(options.mainContentElement || '#mainContent');
        this.routes = this.filterRoutesByPermission(options.routes || []); // Filter routes based on permissions
        this.currentPath = options.currentPath || window.location.pathname;
        this.isCollapsed = false;
        this.activeSubmenuTitle = null;
        this.bg = options.bg || '#023c40';
        $(this.$sidebarElement).addClass(`bg-[${this.bg}]`);
        this.initialize();
    }

    initialize() {

        this.renderMenu();
        this.$sidebarTextElements = this.$sidebarElement.find('.sidebar-text');
        this.$submenuElements = this.$sidebarElement.find('.submenu');
        this.$chevronElements = this.$sidebarElement.find('.chevron');
        this.setInitialActiveState();
        this.bindEventListeners();
        this.handleResponsiveDesign();
    }
    filterRoutesByPermission(routes) {
        return routes
            .filter(route => route.permission !== false) // Include only routes with permission (default to true if undefined)
            .map(route => {
                if (route.submenu) {
                    route.submenu = route.submenu.filter(subItem => subItem.permission !== false);
                }
                return route;
            })
            .filter(route => !route.submenu || route.submenu.length > 0); // Remove parent items if all submenus are filtered out
    }
    renderMenu() {
        const menuHtml = this.routes.map(route => {
            const hasSubmenu = route.submenu && route.submenu.length > 0;
            const isActive = route.link === this.currentPath || (hasSubmenu && route.submenu.some(sub => sub.link === this.currentPath));
            const submenuHtml = hasSubmenu ? `
                <ul class="submenu mt-2 ${isActive && !this.isCollapsed ? 'block' : 'hidden'} bg-white/10 rounded-md p-1">
                    ${route.submenu.map((subItem, index, array) => `
                        <li class="${index < array.length - 1 ? 'mb-1' : ''}">
                            <a href="${subItem.link}" class="block  px-4 py-2 text-sm font-light rounded-sm ${subItem.link === this.currentPath ? `active bg-[${this.bg}]` : 'hover:bg-gray-100/10'}">${subItem.title}</a>
                        </li>
                    `).join('')}
                </ul>
            ` : '';

            if (isActive && hasSubmenu) {
                this.activeSubmenuTitle = route.title;
            }

            return `
                <li class="menu-item px-4 py-2 mb-1 hover:bg-white/10 ${isActive && !this.isCollapsed && !hasSubmenu ? 'bg-white/10' : ''} rounded-md relative">
                    ${hasSubmenu ? `
                        <div class="flex items-center justify-between cursor-pointer submenu-toggle">
                            <div class="flex items-center">
                                <i class="${route.icon}"></i>
                                <span class="sidebar-text ml-3 text-sm font-light">${route.title}</span>
                            </div>
                            <i class="fa-duotone fa-chevron-down sidebar-text chevron text-xs ${isActive && !this.isCollapsed ? 'rotate-180' : ''} transition-all duration-300"></i>
                        </div>
                        ${submenuHtml}
                    ` : `
                        <a href="${route.link}" class="flex items-center">
                            <i class="${route.icon}"></i>
                            <span class="sidebar-text ml-3 text-sm font-light">${route.title}</span>
                        </a>
                        <span class="tooltip">${route.title}</span>
                    `}
                </li>
            `;
        }).join('');
        const $ul = $('<ul>').addClass('py-4 px-2').html(menuHtml);
        this.$sidebarElement.html($ul);
    }

    setInitialActiveState() {
        if (this.activeSubmenuTitle) {
            const $activeMenuItem = this.$sidebarElement.find(`.menu-item:contains('${this.activeSubmenuTitle}')`);
            $activeMenuItem.find('.submenu').addClass('submenu-expanded').show();
            $activeMenuItem.find('.chevron').addClass('rotate-180');
        }
    }

    bindEventListeners() {
        this.$toggleElement.on('click', () => this.toggleSidebar());
        this.$sidebarElement.find('.submenu-toggle').on('click', (event) => {
            event.preventDefault();
            if (!this.isCollapsed) this.toggleSubmenu($(event.currentTarget));
        });
        this.$sidebarElement.find('.menu-item').hover(
            (event) => this.handleHoverIn($(event.currentTarget)),
            (event) => this.handleHoverOut($(event.currentTarget))
        );
    }

    toggleSidebar() {
        this.isCollapsed = !this.isCollapsed;
        this.$sidebarElement.toggleClass('sidebar-collapsed');
        this.$mainContentElement.toggleClass('main-content-expanded');
        this.$sidebarTextElements.toggle(!this.isCollapsed);
        this.$submenuElements.hide().removeClass('submenu-expanded block').addClass('hidden').removeAttr('style');
        this.$chevronElements.removeClass('rotate-180');

        if (!this.isCollapsed && this.activeSubmenuTitle) {
            const $activeMenuItem = this.$sidebarElement.find(`.menu-item:contains('${this.activeSubmenuTitle}')`);
            $activeMenuItem.find('.submenu').addClass('submenu-expanded').show();
            $activeMenuItem.find('.chevron').addClass('rotate-180');
            $activeMenuItem.find('.submenu').find('li a.active').removeClass('bg-gray-200');

        }
    }

    toggleSubmenu($toggleElement) {
        const $parentElement = $toggleElement.parent();
        const $submenuElement = $parentElement.find('.submenu');
        const $chevronElement = $parentElement.find('.chevron');
        this.$submenuElements.not($submenuElement).slideUp(300).removeClass('submenu-expanded');
        this.$chevronElements.not($chevronElement).removeClass('rotate-180');
        $submenuElement.slideToggle(300).toggleClass('submenu-expanded');
        $chevronElement.toggleClass('rotate-180');
    }

    handleHoverIn($menuItem) {
        if (this.isCollapsed && $menuItem.find('.submenu').length) {
            const $submenuElement = $menuItem.find('.submenu');
            $submenuElement
                .css({
                    position: 'absolute',
                    left: '50px',
                    top: '0',
                    width: '200px',
                    color: 'black',
                    border: '1px solid #2020202a',
                    boxShadow: '0 2px 6px rgba(0, 0, 0, 0.1)',
                    fontWeight: 'bold',
                })
                .slideDown(300);
            $submenuElement.find('li a').css({ fontWeight: 'normal' });
            $submenuElement.find('li a.active').addClass('bg-gray-200');
            $submenuElement.find('li:not(:has(a.active))').addClass('hover:bg-gray-100 rounded-md');
            $submenuElement.addClass('!bg-white').removeClass('bg-white/10');
        }
    }

    handleHoverOut($menuItem) {
        if (this.isCollapsed) {
            const $submenuElement = $menuItem.find('.submenu');
            $submenuElement.slideUp().removeAttr('style');
            $submenuElement.removeClass('!bg-white').addClass('bg-white/10');
            $submenuElement.find('li').removeClass('hover:bg-gray-100');
        }
    }

    handleResponsiveDesign() {
        const adjustSidebarForScreenSize = () => {
            const windowWidth = $(window).width();
            if (windowWidth < 768 && !this.isCollapsed) this.toggleSidebar();
            else if (windowWidth >= 768 && this.isCollapsed) this.toggleSidebar();
        };
        adjustSidebarForScreenSize();
        $(window).on('resize', adjustSidebarForScreenSize);
    }
}

class Dropdown {
    constructor(options = {}) {
        this.triggerSelector = options.triggerElement;
        this.dropdownItems = options.items || [];
        this.dropdownId = options.id || `dropdown-${Math.floor(Math.random() * 1000)}`;
        this.initialize();
    }

    initialize() {
        this.renderDropdown();
        this.$triggerElement = $(`#${this.dropdownId}`).prev();
        this.$dropdownElement = $(`#${this.dropdownId}`);
        this.bindEventListeners();
    }

    renderDropdown() {
        const $originalTrigger = $(this.triggerSelector);
        const dropdownHtml = `
            <div class="relative">
                <button id="${this.triggerSelector.slice(1)}" class="cursor-pointer">${$originalTrigger.html()}</button>
                <div id="${this.dropdownId}" class="dropdown-menu p-1.5 border border-gray-200 rounded-md shadow-md">
                    ${this.dropdownItems.map(item => `
                        <a href="${item.link}" class="block px-4 rounded-md py-2 text-sm text-gray-700 hover:bg-gray-100"><i class="${item.icon} mr-2"></i> ${item.title}</a>
                    `).join('')}
                </div>
            </div>
        `;
        $originalTrigger.replaceWith(dropdownHtml);
    }

    bindEventListeners() {
        this.$triggerElement.on('click', (event) => {
            event.preventDefault();
            this.toggleDropdown();
        });

        $(document).on('click', (event) => {
            const $target = $(event.target);
            if (!this.$triggerElement.is($target.parent('button')) &&
                !this.$triggerElement.has($target.parent('button')).length &&
                !this.$dropdownElement.is($target.parent('button')) &&
                !this.$dropdownElement.has($target.parent('button')).length) {
                this.hideDropdown();
            }
        });
    }

    toggleDropdown() {
        if (this.$dropdownElement.hasClass('active')) {
            this.hideDropdown();
        } else {
            this.showDropdown();
        }
    }

    showDropdown() {
        this.$dropdownElement.addClass('active');
    }

    hideDropdown() {
        this.$dropdownElement.removeClass('active');
    }
}
// Breadcrumb Component 
class Breadcrumb {
    constructor(options = {}) {
        this.$breadcrumbElement = $(options.breadcrumbElement || '#breadcrumbs');
        this.routes = options.routes || [];
        this.currentPath = options.currentPath || window.location.pathname;
        this.initialize();
    }

    initialize() {
        this.renderBreadcrumb();
        this.bindEventListeners();
    }

    getBreadcrumbTrail() {
        const trail = [];
        const findRoute = (routes, path) => {
            for (const route of routes) {
                if (route.link === path) {
                    trail.push(route);
                    return true;
                }
                if (route.submenu) {
                    for (const subRoute of route.submenu) {
                        if (subRoute.link === path) {
                            trail.push(route, subRoute);
                            return true;
                        }
                        if (subRoute.submenu) {
                            for (const subSubRoute of subRoute.submenu) {
                                if (subSubRoute.link === path) {
                                    trail.push(route, subRoute, subSubRoute);
                                    return true;
                                }
                            }
                        }
                    }
                }
            }
            return false;
        };
        findRoute(this.routes, this.currentPath);
        return trail.length ? [{ title: 'Home', link: '/', icon: 'fa-duotone fa-home' }, ...trail] : [{ title: 'Home', link: '/', icon: 'fa-duotone fa-home' }];
    }

    renderBreadcrumb() {
        const trail = this.getBreadcrumbTrail();
        const breadcrumbHtml = `
          <ol class="flex items-center space-x-2 text-xs">
            ${trail.map((item, index) => `
              <li class="flex items-center relative">
                ${index === trail.length - 1 ? `
                  <span class="text-gray-900 font-medium px-2 py-1 rounded" aria-current="page">${item.title}</span>
                ` : `
                  <div class="relative group">
                    <a href="${item.link || 'javascript:void(0)'}" class="flex items-center text-gray-500 hover:text-gray-900 transition-colors duration-200 px-2 py-1 rounded">
                      ${item.icon ? `<i class="${item.icon} mb-[2px] mr-2"></i>` : ''}
                      <span class="hidden md:inline">${item.title}</span>
                    </a>
                    ${item.submenu ? `
                      <div class="p-1.5 border border-gray-200 rounded-md absolute top-full right-0 mt-1  bg-white shadow-md z-10 transition-all ease-in-out duration-200 opacity-0 group-hover:opacity-100 translate-y-[-15px] group-hover:translate-y-0 hover:opacity-100 hover:translate-y-0">
                        <ul class="">
                          ${item.submenu.map(subItem => `
                            <li>
                              <a href="${subItem.link}" class="block px-4 rounded-md py-2 text-xs  text-gray-700 hover:bg-gray-100">
                                ${subItem.title}
                              </a>
                            </li>
                          `).join('')}
                        </ul>
                      </div>
                    ` : ''}
                  </div>
                `}
                ${index < trail.length - 1 ? `
                  <svg class="w-4 h-4 text-gray-400 mx-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                  </svg>
                ` : ''}
              </li>
            `).join('')}
          </ol>
        `;
        this.$breadcrumbElement.html(breadcrumbHtml);
    }

    bindEventListeners() {
        // Additional interactivity can be added here if needed
        this.$breadcrumbElement.on('click', '.dropdown-toggle', (e) => {
            e.preventDefault();
            const $dropdown = $(e.currentTarget).siblings('.dropdown-menu');
        });
    }

    updateBreadcrumb(newPath) {
        this.currentPath = newPath;
        this.renderBreadcrumb();
    }
}
// Form Component
// class Form {
//     constructor(options = {}) {
//         this.$formElement = $(options.formElement || '#form');
//         this.grid = options.grid || '1';
//         this.title = options.title || '';
//         this.onSubmit = options.onSubmit || ((data) => console.log(`${this.title} submitted:`, data));
//         this.fields = options.fields || [];
//         this.initialize();
//     }

//     initialize() {
//         this.renderForm();
//         this.bindEventListeners();
//     }

//     renderForm() {
//         const gridClasses = { '1': 'grid-cols-1', '2': 'grid-cols-2', '3': 'grid-cols-3' };
//         const formHtml = `
//         <form class="space-y-6">
//           <h2 class="text-2xl font-semibold text-gray-900">${this.title}</h2>
//           <div class="grid ${gridClasses[this.grid] || 'grid-cols-1'} gap-6">
//             ${this.fields.map(field => `
//               <div class="space-y-2">
//                 <label class="block text-sm font-medium text-gray-700">
//                   ${field.label} ${field.required ? '<span class="text-red-500">*</span>' : ''}
//                 </label>
//                 ${this.renderField(field)}
//                 <p class="hidden text-red-500 text-xs mt-1 error-message" id="${field.name}-error"></p>
//               </div>
//             `).join('')}
//           </div>
//           <div class="flex justify-end gap-2">
//             <button
//               type="submit"
//               class="px-4 py-2 text-xs font-medium bg-gray-300 rounded-md hover:bg-gray-300/90 focus:outline-none focus:ring-2 focus:ring-[#023c40]/50 focus:ring-offset-2 transition-all duration-200"
//             >
//               <i class="fa-duotone fa-arrow-left mr-2"></i> Back
//             </button>
//             <button
//               type="submit"
//               class="px-4 py-2 text-xs text-white font-light bg-[#023c40] rounded-md shadow-md hover:bg-[#023c40]/90 focus:outline-none focus:ring-2 focus:ring-[#023c40]/50 focus:ring-offset-2 transition-all duration-200"
//             >
//                Submit <i class="fa-duotone fa-arrow-right ml-2"></i>
//             </button>
//         </div>
//         </form>
//       `;
//         this.$formElement.html(formHtml);
//     }

//     renderField(field) {
//         const baseClasses = `w-full px-3 py-2 text-gray-700 border rounded-md focus:outline-none focus:ring-2 focus:ring-[#023c40]/50 focus:border-transparent transition-all duration-200 ${field.required ? 'border-gray-300' : 'border-gray-200'}`;
//         switch (field.type) {
//             case 'textarea':
//                 return `<textarea id="${field.name}" name="${field.name}" placeholder="${field.placeholder || ''}" class="${baseClasses}" rows="${field.rows || 2}" ${field.maxLen ? `maxlength="${field.maxLen}"` : ''}></textarea>`;
//             case 'select':
//                 return `
//               <select id="${field.name}" name="${field.name}" class="${baseClasses}">
//                 <option value="">${field.placeholder || 'Select an option'}</option>
//                 ${field.options.map(opt => `<option value="${opt.value}">${opt.label}</option>`).join('')}
//               </select>
//             `;
//             case 'checkbox':
//                 return field.options ? `
//               <div class="space-y-2">
//                 ${field.options.map((opt, index) => `
//                   <div class="flex items-center">
//                     <input type="checkbox" id="${field.name}_${index}" name="${field.name}[]" value="${opt.value}" class="h-4 w-4 text-[#023c40] focus:ring-[#023c40]/50 border-gray-300 rounded" />
//                     <label for="${field.name}_${index}" class="ml-2 text-sm text-gray-700">${opt.label}</label>
//                   </div>
//                 `).join('')}
//               </div>
//             ` : `
//               <div class="flex items-center">
//                 <input type="checkbox" id="${field.name}" name="${field.name}" class="h-4 w-4 text-[#023c40] focus:ring-[#023c40]/50 border-gray-300 rounded" />
//                 <label for="${field.name}" class="ml-2 text-sm text-gray-700">${field.label}</label>
//               </div>
//             `;
//             case 'radio':
//                 return field.options ? `
//               <div class="space-y-2">
//                 ${field.options.map((opt, index) => `
//                   <div class="flex items-center">
//                     <input type="radio" id="${field.name}_${index}" name="${field.name}" value="${opt.value}" class="h-4 w-4 text-[#023c40] focus:ring-[#023c40]/50 border-gray-300" />
//                     <label for="${field.name}_${index}" class="ml-2 text-sm text-gray-700">${opt.label}</label>
//                   </div>
//                 `).join('')}
//               </div>
//             ` : `
//               <div class="flex items-center">
//                 <input type="radio" id="${field.name}" name="${field.name}" class="h-4 w-4 text-[#023c40] focus:ring-[#023c40]/50 border-gray-300" />
//                 <label for="${field.name}" class="ml-2 text-sm text-gray-700">${field.label}</label>
//               </div>
//             `;
//             case 'file':
//                 return `
//               <input type="file" id="${field.name}" name="${field.name}" class="w-full text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-[#023c40]/10 file:text-[#023c40] hover:file:bg-[#023c40]/20" />
//             `;
//             case 'number':
//                 return `
//               <input
//                 type="text"
//                 id="${field.name}"
//                 name="${field.name}"
//                 placeholder="${field.placeholder || ''}"
               
//                 class="${baseClasses}"
//                 data-type="number"
//                 data-decimals="${field.decimals || 2}"
//               />
//             `;
//             default:
//                 return `
//               <input type="${field.type || 'text'}" id="${field.name}" name="${field.name}" placeholder="${field.placeholder || ''}" class="${baseClasses}" />
//             `;
//         }
//     }

//     bindEventListeners() {
//         const $form = this.$formElement.find('form');

//         $form.find('input[data-type="number"]').each((_, el) => {
//             const $input = $(el);
//             const decimals = parseInt($input.attr('data-decimals')) || 2;
//             $input.on('input', () => {
//                 let value = $input.val().replace(/[^0-9.]/g, '');
//                 const parts = value.split('.');
//                 const filteredParts = parts.filter(Boolean);

//                 let formattedValue = filteredParts[0] || '';
//                 if (filteredParts.length > 1) {
//                     formattedValue += '.' + filteredParts[1].slice(0, decimals);
//                 }

//                 if (formattedValue && !isNaN(formattedValue)) {
//                     const hasDecimal = value.includes('.');
//                     const cursorPosition = $input[0].selectionStart;
//                     const finalValue = Number(formattedValue).toLocaleString('en-US', {
//                         minimumFractionDigits: 0,
//                         maximumFractionDigits: decimals
//                     }) + (hasDecimal && filteredParts.length === 1 ? '.' : '');

//                     $input.val(finalValue);
//                     const diff = finalValue.length - value.length;
//                     $input[0].setSelectionRange(cursorPosition + diff, cursorPosition + diff);
//                 } else {
//                     $input.val(formattedValue);
//                 }
//             });
//         });

//         $form.find('input, textarea, select').on('input change', (e) => {
//             const $input = $(e.target);
//             const name = $input.attr('name').replace('[]', '');
//             const value = $input.attr('type') === 'checkbox' ? $input.prop('checked') : $input.val().trim();
//             const $error = $(`#${name}-error`);
//             const field = this.fields.find(f => f.name === name);

//             if (field.maxLen && value.length > field.maxLen) {
//                 $input.val(value.slice(0, field.maxLen));
//                 return;
//             }

//             if (field.required && !this.isFieldValid(field, $form)) {
//                 $error.text(`${field.label} is required`).removeClass('hidden');
//             } else if (field.minLen && value.length < field.minLen) {
//                 $error.text(`${field.label} must be at least ${field.minLen} characters`).removeClass('hidden');
//             } else if (field.maxLen && value.length > field.maxLen) {
//                 $error.text(`${field.label} must not exceed ${field.maxLen} characters`).removeClass('hidden');
//             } else if (field.type === 'email' && value && !this.isValidEmail(value)) {
//                 $error.text('Please enter a valid email').removeClass('hidden');
//             } else if (field.type === 'number' && value) {
//                 let formattedValue = value.replace(/,/g, '');
//                 if (isNaN(formattedValue)) {
//                     $error.text('Please enter a valid number').removeClass('hidden');
//                 } else if (field.min && parseFloat(formattedValue) < parseFloat(field.min)) {
//                     $error.text(`Please enter a value greater than ${Number(field.min).toLocaleString('en-US')}`).removeClass('hidden');
//                 } else if (field.max && parseFloat(formattedValue) > parseFloat(field.max)) {
//                     $error.text(`Please enter a value less than ${Number(field.max).toLocaleString('en-US')}`).removeClass('hidden');
//                 } else {
//                     $error.addClass('hidden');
//                 }
//             } else {
//                 $error.addClass('hidden');
//             }
//         });

//         $form.on('submit', (e) => {
//             e.preventDefault();
//             this.clearErrors();
//             const formData = this.validateForm();
//             if (formData) {
//                 this.onSubmit(formData);
//             }
//         });
//     }

//     validateForm() {
//         const $form = this.$formElement.find('form');
//         const formData = {};
//         let isValid = true;

//         this.fields.forEach(field => {
//             const $error = $(`#${field.name}-error`);
//             if (field.type === 'checkbox' && field.options) {
//                 const checkedValues = $form.find(`input[name="${field.name}[]"]:checked`).map((_, el) => $(el).val()).get();
//                 formData[field.name] = checkedValues;
//                 if (field.required && checkedValues.length === 0) {
//                     $error.text(`${field.label} requires at least one selection`).removeClass('hidden');
//                     isValid = false;
//                 }
//             } else if (field.type === 'radio' && field.options) {
//                 const selectedValue = $form.find(`input[name="${field.name}"]:checked`).val();
//                 formData[field.name] = selectedValue || '';
//                 if (field.required && !selectedValue) {
//                     $error.text(`${field.label} requires a selection`).removeClass('hidden');
//                     isValid = false;
//                 }
//             } else {
//                 const $input = $form.find(`[name="${field.name}"]`);
//                 let value = field.type === 'checkbox' ? $input.prop('checked') : $input.val().trim();
//                 if (field.type === 'number' && value) {
//                     value = value.replace(/,/g, '');
//                     if (isNaN(value)) {
//                         $error.text('Please enter a valid number').removeClass('hidden');
//                         isValid = false;
//                         return;
//                     }
//                     value = Number(value);
//                 }
//                 if (field.required && !value && value !== 0) {
//                     $error.text(`${field.label} is required`).removeClass('hidden');
//                     isValid = false;
//                 } else if (field.minLen && value.length < field.minLen) {
//                     $error.text(`${field.label} must be at least ${field.minLen} characters`).removeClass('hidden');
//                     isValid = false;
//                 } else if (field.maxLen && value.length > field.maxLen) {
//                     $error.text(`${field.label} must not exceed ${field.maxLen} characters`).removeClass('hidden');
//                     isValid = false;
//                 } else if (field.type === 'email' && value && !this.isValidEmail(value)) {
//                     $error.text('Please enter a valid email').removeClass('hidden');
//                     isValid = false;
//                 } else if (field.type === 'number' && value !== '') {
//                     if (field.min && value < field.min) {
//                         $error.text(`Please enter a value greater than ${Number(field.min).toLocaleString('en-US')}`).removeClass('hidden');
//                         isValid = false;
//                     } else if (field.max && value > field.max) {
//                         $error.text(`Please enter a value less than ${Number(field.max).toLocaleString('en-US')}`).removeClass('hidden');
//                         isValid = false;
//                     }
//                 }
//                 if (isValid) {
//                     formData[field.name] = value;
//                 } else {
//                     isValid = false;
//                 }
//             }
//         });

//         return isValid ? formData : null;
//     }

//     isFieldValid(field, $form) {
//         if (field.type === 'checkbox' && field.options) {
//             return $form.find(`input[name="${field.name}[]"]:checked`).length > 0;
//         } else if (field.type === 'radio' && field.options) {
//             return $form.find(`input[name="${field.name}"]:checked`).length > 0;
//         } else {
//             const $input = $form.find(`[name="${field.name}"]`);
//             const value = field.type === 'checkbox' ? $input.prop('checked') : $input.val().trim();
//             return value !== '' && value !== undefined && value !== null;
//         }
//     }

//     isValidEmail(email) {
//         const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
//         return emailRegex.test(email);
//     }

//     clearErrors() {
//         this.$formElement.find('.error-message').addClass('hidden').text('');
//     }
// }
