function modals() {
    // close modal
    document.body.addEventListener("click", function (event) {
        var closeModalButton = event.target.closest("[close-modal]");
        if (closeModalButton) {
            var modal = closeModalButton.getAttribute('close-modal');
            closeModal(modal);
        }
    });

    // open modal
    document.body.addEventListener("click", function (event) {
        var openModalButton = event.target.closest("[open-modal]");
        if (openModalButton) {
            document.body.classList.add('overflow-hidden');
            var modal = openModalButton.getAttribute('open-modal');
            openModal(modal);
        }
    });
}

function amountsBox() {
    // focus event
    $(document).on('focus', '[amount-box-root] .amount-input', function () {
        $(this).select(); // select value
        $(this).closest('[amount-box-root]').addClass('active');
    });

    // blur event
    $(document).on('blur', '[amount-box-root] .amount-input', function () {
        $(this).closest('[amount-box-root]').removeClass('active');
        $(this).siblings('[val-lbl]').html($(this).val())
    });
}

function share() {
    $(document).off('click', '[share]').on('click', '[share]', function () {
        var link = $(this).attr('share');

        if (!navigator.share) {
            $('body').append(`<textarea id="share-link">${link}</textarea>`);
            document.getElementById('share-link').select();
            document.execCommand("Copy");
            $('#share-link').remove();
        } else {
            var title = $(this).attr('share-title');

            navigator.share({
                title: title,
                url: link
            }).catch(err => console.error(err));
        }
    });
}


function selectFields() {
    if (document.querySelector('[init-select]')) {
        $('[init-select]').each(function(){
            $(this).niceSelect();
        })
    }
}

function toggleTabs() {
    // tabs العادية
    $(document).on('click', '[toggle]', function () {
        var eSelector = $(this).attr('toggle');
        var allTabs = eSelector.substr(0, 3);

        // إزالة active من كل الأزرار
        $('[toggle^=' + allTabs + ']').removeClass('active');

        // تفعيل الزر الحالي
        $(this).addClass('active').siblings().removeClass('active');

        // إخفاء كل العناصر
        $('[data-toggle-tab^=' + allTabs + ']').removeClass('active');

        // إظهار العنصر المطلوب
        $('[data-toggle-tab=' + eSelector + ']').addClass('active');
    });

    // fade مع tabs (لكن بالـ CSS transitions)
    $(document).on('click', '[toggle-fade]', function () {
        var eSelector = $(this).attr('toggle-fade');
        var allTabs = eSelector.substr(0, 3);

        // إزالة active من كل الأزرار
        $('[toggle-fade^=' + allTabs + ']').removeClass('active');

        // تفعيل الزر الحالي
        $(this).addClass('active').siblings().removeClass('active');

        // إخفاء الكل
        $('[data-toggle-fade^=' + allTabs + ']').removeClass('active');

        // إظهار العنصر المطلوب فقط
        $('[data-toggle-fade=' + eSelector + ']').addClass('active');
    });
}
function projects_page() {
    if (isMobile && $('[filteration-wrap]').length > 0) {

        $('[filteration-wrap] input[type=radio]').on('change', function() {
            $('[filtration-amt]')
                .addClass('active')
                .slideDown(200);
        });
    }
}



function initApp() {
    modals();
    amountsBox();
    share();
    selectFields();
    toggleTabs();
    projects_page();
}

document.addEventListener("DOMContentLoaded", initApp);
document.addEventListener("livewire:load", initApp);
document.addEventListener("livewire:navigated", initApp);
document.addEventListener("livewire:updated", initApp);





