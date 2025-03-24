$(document).ready(() => {

    // Sidebar init
    const currentPath = '/permissions';
    const sidebarRoutes = [
        {
            icon: 'fa-duotone fa-house',
            title: 'Dashboard',
            link: '/dashboard',
            permission: true
        },
        {
            icon: 'fa-duotone fa-circle-user',
            title: 'Administration',
            submenu: [
                { title: 'Users', link: '/users', permission: true },
                { title: 'Permissions', link: '/permissions', permission: true },
            ]
        },
        {
            icon: 'fa-duotone fa-screwdriver-wrench',
            title: 'Settings',
            link: '/settings',
            permission: true
        },
        {
            icon: 'fa-duotone fa-right-from-bracket',
            title: 'Logout',
            link: '/logout',
            permission: true
        }
    ];

    new Sidebar({
        bg: '#023c40',
        routes: sidebarRoutes,
        sidebarElement: '#sidebar',
        sidebarMenuElement: '#sidebarMenu',
        toggleElement: '#toggleSidebar',
        mainContentElement: '#mainContent',
        currentPath
    });


    // Breadcrumb init
    new Breadcrumb({
        breadcrumbElement: '#breadcrumbs',
        routes: sidebarRoutes,
        currentPath
    });


    // Profile Menu Dropdown init
    new Dropdown({
        triggerElement: '#profileMenu',
        items: [
            { title: 'Profile', link: '#', icon: 'fa-duotone fa-user' },
            { title: 'Settings', link: '#', icon: 'fa-duotone fa-gear' }, ,
            { title: 'Logout', link: '#', icon: 'fa-duotone fa-right-from-bracket' },
        ]
    });

    // Notifications Menu Dropdown init
    new Dropdown({
        triggerElement: '#notificationsMenu',
        items: [
            { title: 'New Message', link: '#', icon: 'fa-duotone fa-envelope' },
            { title: 'System Update', link: '#', icon: 'fa-duotone fa-gear' }
        ]
    });

    // Product Form init
    // const form = new Form({
    //     grid: '2',
    //     formElement: '#form',
    //     // title: 'Add Product',
    //     fields: [
    //         {
    //             label: 'Product Name',
    //             name: 'name',
    //             type: 'text',
    //             required: true,
    //             placeholder: 'Enter product name',
    //             minLen: 3,
    //             maxLen: 50
    //         },
    //         {
    //             label: 'Price',
    //             name: 'price',
    //             type: 'number',
    //             required: true,
    //             placeholder: 'Enter price',
    //             decimals: 3,
    //             min: 100,
    //             max: 15000
    //         },
    //         {
    //             label: 'Description',
    //             name: 'description',
    //             type: 'textarea',
    //             rows: 2,
    //             placeholder: 'Product description',
    //             maxLen: 500,
    //             minLen: 10
    //         },
    //         {
    //             label: 'Category',
    //             name: 'category',
    //             type: 'select',
    //             required: true,
    //             options: [
    //                 { value: 'electronics', label: 'Electronics' },
    //                 { value: 'clothing', label: 'Clothing' }
    //             ]
    //         },
    //         {
    //             label: 'File',
    //             name: 'file',
    //             type: 'file',
    //             required: true
    //         },
    //         {
    //             label: 'Type',
    //             name: 'type',
    //             type: 'checkbox',
    //             options: [
    //                 { value: 'physical', label: 'Physical' },
    //                 { value: 'digital', label: 'Digital' },
    //                 { value: 'service', label: 'Service' }
    //             ],
    //             required: true
    //         },
    //         {
    //             label: 'Rating',
    //             name: 'rating',
    //             type: 'radio',
    //             options: [
    //                 { value: '1', label: '1 Star' },
    //                 { value: '2', label: '2 Stars' },
    //                 { value: '3', label: '3 Stars' },
    //                 { value: '4', label: '4 Stars' },
    //                 { value: '5', label: '5 Stars' }
    //             ],
    //             required: true
    //         },

    //     ],
    //     onSubmit: (data) => console.log('Product Data:', data)
    // });

});