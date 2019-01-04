var menuItems = [].slice.call(document.querySelectorAll('.hover-category')),
    menuSubs = [].slice.call(document.querySelectorAll('.dropdown-menu1')),
    selectedMenu = undefined,
    subBg = document.querySelector('.dropdown__bg'),
    subBgBtm = document.querySelector('.dropdown__bg-bottom'),
    subArr = document.querySelector('.dropdown__arrow'),
    subCnt = document.querySelector('.dropdown__wrap'),
    header = document.querySelector('.main-header'),
    closeDropdownTimeout,

    startCloseTimeout = function startCloseTimeout() {
        // console.log("test");
       closeDropdownTimeout = setTimeout(function () {return closeDropdown();}, 50);
    },

    stopCloseTimeout = function stopCloseTimeout() {
        // console.log("test-1");
        clearTimeout(closeDropdownTimeout);
    },

    openDropdown = function openDropdown(el) {

        //- get menu ID
        var menuId = el.getAttribute('data-sub');
        // console.log(menuId.length)
        //- get related sub menu
        var menuSub = document.querySelector('.dropdown-menu1[data-sub="'+menuId+'"]');
        //- get menu sub content
        var menuSubCnt = menuSub.querySelector('.dropdown-menu__content');
        //- get bottom section of current sub
        // var menuSubBtm = menuSubCnt.querySelector('.bottom-section').getBoundingClientRect();
        //- get height of top section
        var menuSubTop = menuSubCnt.querySelector('.top-section').getBoundingClientRect();
        //- get menu position
        var menuMeta = el.getBoundingClientRect();
        //- get sub menu position
        var subMeta = menuSubCnt.getBoundingClientRect();


        //- set selected menu
        selectedMenu = menuId;


        //- Remove active Menu
        menuItems.forEach(function (el) {return el.classList.remove('active');});
        //- Set current menu to active
        el.classList.add('active');

        //- Remove active sub menu
        menuSubs.forEach(function (el) {return el.classList.remove('active');});
        //- Set current menu to active
        menuSub.classList.add('active');

        //- Set dropdown menu background style to match current submenu style
        subBg.style.opacity = 1;
        subBg.style.display = 'block';
        // subBg.style.left = menuMeta.left - (subMeta.width / 2 - menuMeta.width / 2) + 'px';
        // subBg.style.width = subMeta.width + 'px';
        // subBg.style.height = subMeta.height + 'px';
        //- Set dropdown menu bottom section background position
        // subBgBtm.style.top = menuSubTop.height + 'px';
        // console.log(menuSubBtm);

        //- Set Arrow position
        subArr.style.opacity = 1;
        subArr.style.left = menuMeta.left + menuMeta.width / 2 - 10 + 'px';

        //- Set sub menu style
        subCnt.style.opacity = 1;
        subCnt.style.display = 'block';
        // subCnt.style.left = menuMeta.left - (subMeta.width / 2 - menuMeta.width / 2) + 'px';
        // subCnt.style.width = subMeta.width + 'px';
        // subCnt.style.height = subMeta.height + 'px';

        //- Set current sub menu style
        menuSub.style.opacity = 1;
        menuSub.style.display = 'block';

        header.classList.add('dropdown-active');

    },
    closeDropdown = function closeDropdown() {

        //- Remove active class from all menu items
        menuItems.forEach(function (el) {return el.classList.remove('active');});
        //- Remove active class from all sub menus
        menuSubs.forEach(function (el) {
            el.classList.remove('active');
            el.style.opacity = 0;
            el.style.display = 'none'
        });
        //- set sub menu background opacity
        subBg.style.opacity = 0;
        subBg.style.display = 'none';

        //- set arrow opacity
        subArr.style.opacity = 0;
        subCnt.style.display = 'none'

        // unset selected menu
        selectedMenu = undefined;

        header.classList.remove('dropdown-active');
    };


//- Binding mouse event to each menu items
menuItems.forEach(function (el) {
    // console.log(el);
    //- mouse enter event
    el.addEventListener('mouseenter', function () {
        stopCloseTimeout();
        openDropdown(this);

    }, false);

    //- mouse leave event
    el.addEventListener('mouseleave', function () {return startCloseTimeout();}, false);

});

//- Binding mouse event to each sub menus
menuSubs.forEach(function (el) {
// console.log(el);
   el.addEventListener('mouseenter', function () {return stopCloseTimeout();}, false);
   el.addEventListener('mouseleave', function () {return startCloseTimeout();}, false);

});