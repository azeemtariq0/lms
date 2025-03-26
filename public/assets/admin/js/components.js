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
            .filter(route => route.permission != false) // Include only routes with permission (default to true if undefined)
            .map(route => {
                if (route.submenu) {
                    route.submenu = route.submenu.filter(subItem => subItem.permission != false);
                }
                return route;
            })
            .filter(route => !route.submenu || route.submenu.length > 0); // Remove parent items if all submenus are filtered out
    }
    renderMenu() {
        const menuHtml = this.routes.map(route => {
            const hasSubmenu = route.submenu && route.submenu.length > 0;
            const isActive = route.key === this.currentPath || (hasSubmenu && route.submenu.some(sub => sub.key === this.currentPath));
            const submenuHtml = hasSubmenu ? `
                <ul class="submenu mt-2 ${isActive && !this.isCollapsed ? 'block' : 'hidden'} bg-white/10 rounded-md p-1">
                    ${route.submenu.map((subItem, index, array) => `
                        <li class="${index < array.length - 1 ? 'mb-1' : ''}">
                            <a href="${subItem.link}" class="block  px-4 py-2 text-sm font-light rounded-sm ${subItem.key === this.currentPath ? `active bg-[${this.bg}]` : 'hover:bg-gray-100/10'}">${subItem.title}</a>
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
                            <i class="fa-solid fa-chevron-down sidebar-text chevron text-xs ${isActive && !this.isCollapsed ? 'rotate-180' : ''} transition-all duration-300"></i>
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

// class Dropdown {
//     constructor(options = {}) {
//         this.triggerSelector = options.triggerElement;
//         this.dropdownItems = options.items || [];
//         this.dropdownId = options.id || `dropdown-${Math.floor(Math.random() * 1000)}`;
//         this.initialize();
//     }

//     initialize() {
//         this.renderDropdown();
//         this.$triggerElement = $(`#${this.dropdownId}`).prev();
//         this.$dropdownElement = $(`#${this.dropdownId}`);
//         this.bindEventListeners();
//     }

//     renderDropdown() {
//         const $originalTrigger = $(this.triggerSelector);
//         const dropdownHtml = `
//             <div class="relative">
//                 <button id="${this.triggerSelector.slice(1)}" class="cursor-pointer">${$originalTrigger.html()}</button>
//                 <div id="${this.dropdownId}" class="dropdown-menu p-1.5 border border-gray-200 rounded-md shadow-md">
//                     ${this.dropdownItems.map(item => `
//                         <a href="${item.link || 'javascript:void(0)'}" ${item.onClick ? `onclick="${item.onClick}"` : ''} class=" block px-4 rounded-md py-2 text-sm text-gray-700 cursor-pointer ${item.link ? 'hover:bg-gray-100' : ' text-gray-900 !cursor-default'}"><i class="${item.icon} mr-2"></i> ${item.title}</a>
//                     `).join('')}
//                 </div>
//             </div>
//         `;
//         $originalTrigger.replaceWith(dropdownHtml);
//     }

//     bindEventListeners() {
//         this.$triggerElement.on('click', (event) => {
//             event.preventDefault();
//             this.toggleDropdown();
//         });

//         $(document).on('click', (event) => {
//             const $target = $(event.target);
//             if (!this.$triggerElement.is($target.parent('button')) &&
//                 !this.$triggerElement.has($target.parent('button')).length &&
//                 !this.$dropdownElement.is($target.parent('button')) &&
//                 !this.$dropdownElement.has($target.parent('button')).length) {
//                 this.hideDropdown();
//             }
//         });
//     }

//     toggleDropdown() {
//         if (this.$dropdownElement.hasClass('active')) {
//             this.hideDropdown();
//         } else {
//             this.showDropdown();
//         }
//     }

//     showDropdown() {
//         this.$dropdownElement.addClass('active');
//     }

//     hideDropdown() {
//         this.$dropdownElement.removeClass('active');
//     }
// }
class Dropdown {
    constructor(selector, options = {}) {
        this.$triggerElement = $(selector);
        this.options = options.options || [];
        this.onChange = options.onChange || null;
        this.dropdownId = `dropdown-${Math.floor(Math.random() * 1000)}`;
        this.selectedOption = null; // Set initial selection

        this.initialize();
    }

    initialize() {
        if (this.$triggerElement.length === 0) {
            console.error(`Dropdown trigger element ${this.$triggerElement.selector} not found!`);
            return;
        }

        this.renderDropdown();
        this.$dropdownElement = $(`#${this.dropdownId}`);
        this.bindEventListeners();
    }

    renderDropdown() {
        const initialText = this.selectedOption
            ? this.selectedOption.label
            : this.$triggerElement.html().trim() || "Select Option";

        const dropdownHtml = `
        <div class="relative inline-block">
            <button id="${this.$triggerElement.attr('id')}" 
                    class="cursor-pointer ${this.$triggerElement.attr('class') || ''}">
                ${initialText}
            </button>
            <div id="${this.dropdownId}" 
                 class="dropdown-menu p-1.5 border border-gray-200 rounded-md shadow-md ">
                ${this.options.map(option => `
                    <a href="javascript:void(0)" data-href="${option.link || ''}" 
                       data-value="${option.value || ''}" 
                       class="dropdown-item block px-4 rounded-md py-2 text-sm text-gray-700 cursor-pointer hover:bg-gray-100 ${option.className ?? ''}">
                        ${option.label}
                    </a>
                `).join('')}
            </div>
        </div>
    `;
        this.$triggerElement.replaceWith(dropdownHtml);
        this.$triggerElement = $(`#${this.$triggerElement.attr('id')}`);
    }

    bindEventListeners() {
        const $button = $(`#${this.$triggerElement.attr('id')}`);
        const $dropdown = $(`#${this.dropdownId}`);

        $button.on('click', (event) => {
            event.preventDefault();
            $dropdown.toggleClass('active');
        });

        $dropdown.on('click', '.dropdown-item', (event) => {
            event.preventDefault();
            const $target = $(event.target);
            const selectedValue = $target.data('value');
            const href = $target.data('href');
            const selectedLabel = $target.text();


            // Trigger onChange callback
            if (typeof this.onChange === "function") {
                this.selectedOption = { value: selectedValue, label: selectedLabel };
                $button.text(selectedLabel);
                this.onChange(this.selectedOption);
            } else {
                if (href) {
                    window.location.href = href;
                }
            }
            if (href || this.onChange) {
                this.hideDropdown();
            }
        });

        $(document).on('click', (event) => {
            if (!$button.is(event.target) && !$dropdown.is(event.target) && !$dropdown.has(event.target).length) {
                this.hideDropdown();
            }
        });
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
                if (route.key === path) {
                    trail.push(route);
                    return true;
                }
                if (route.submenu) {
                    for (const subRoute of route.submenu) {
                        if (subRoute.key === path) {
                            trail.push(route, subRoute);
                            return true;
                        }
                        if (subRoute.submenu) {
                            for (const subSubRoute of subRoute.submenu) {
                                if (subSubRoute.key === path) {
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
        return trail.length ? [{ title: 'Home', link: '/admin   ', icon: 'fa-solid fa-home' }, ...trail] : [{ title: 'Home', link: '/', icon: 'fa-solid fa-home' }];
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
                      <div class="p-1.5 border border-gray-200 rounded-md absolute top-full right-0 mt-1  bg-white shadow-md z-10 transition-all ease-in-out duration-200 opacity-0 invisible group-hover:visible group-hover:opacity-100 translate-y-[-15px] group-hover:translate-y-0 hover:opacity-100 hover:translate-y-0">
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