$(document).ready(function () {
    // Modal Show
    $('#Pages').modal('show');

    $("body").on('change', "input[type='checkbox']", function () {
        $("input[type='checkbox']").not(this).prop('checked', false);
    });
    $("body").on('change', 'label.select-menu-item', function (e) {
        e.preventDefault();
        if ($(this).attr('aria-checked') === 'false') {
            $(this).find("input[type=checkbox]").prop('checked', true);
            changeCheckbox();
        } else if ($(this).attr('aria-checked') === 'true') {
            $(this).find("input[type=checkbox]").prop('checked', false);
            changeCheckbox();
        }
    });



    var listButtonElement = $('#list-button');
    var thumbnailButtonElement = $('#thumbnail-button');
    var element = $('#detail-gallery');

    listButtonElement.css('z-index', 1);
    thumbnailButtonElement.css('z-index', -1);

    var zIndexList = thumbnailButtonElement.css('z-index');
    var zIndexThumbnail = thumbnailButtonElement.css('z-index');

    var changeListElement = $("#change-list");
    var changeThmbnailElement = $("#change-thumbnail");

    $(".content").find("#thumbnail-gallery").css('display', 'none');

    changeButtonStatus();
    if (zIndexList == -1) {
        changeListElement.css('cursor', 'pointer');
        changeThmbnailElement.css('cursor', 'unset');

        $('#change-list').on('click', function () {
            onChangeElement('list');
        })
    }

    if (zIndexThumbnail == -1) {
        changeThmbnailElement.css('cursor', 'pointer');
        changeListElement.css('cursor', 'unset');

        $('#change-thumbnail').on('click', function () {
            onChangeElement('thumbnail');
        })
    }

    $('.apply').on('click', function () {
        onChangeElement('list');
    })
});

var changeButtonStatus = function () {
    var thumbnailButtonElement = $('#thumbnail-button');

    var zIndexThumbnail = thumbnailButtonElement.css('z-index');

    if (zIndexThumbnail == -1) {

        var changeList = $('#change-list');
        var changeThumbnail = $('#change-thumbnail');

        changeList.find('.button').css({
            'background-color': '#F942F8',
            'border-color': '#F942F8'
        });
        changeList.find('.list-icon').css('color', '#fff');
        changeThumbnail.find('.button').css({
            'background-color': '#fff',
            'border-color': '#C4C4C4'
        });
        changeThumbnail.find('.thumbnail-icon').css('color', '#51EA2C');

    }
}

var onChangeElement = function ($element) {
    var changeThmbnailElement = $("#change-thumbnail");
    var changeListElement = $("#change-list");
    var listButtonElement = $('#list-button');
    var thumbnailButtonElement = $('#thumbnail-button');
    var detailGallery = $('#detail-gallery');
    if ($element == 'thumbnail') {
        $('div.box.no-download').hide();
        detailGallery.find('.wrapper').css('grid-template-columns', 'repeat(5, minmax(100px, 270px))');
        detailGallery.find('.icon-function-area, .description-content').css('display', 'none');
        detailGallery.find('.top-content, .list-row, .date-time-area').css('display', 'none');
        detailGallery.find('.content-container').css({
            'height': '275px',
            'border': 'none'
        });
        detailGallery.find('.date-area').css('display', 'block');
        detailGallery.find('.thumbnail-row, .button-row').css('display', 'flex');
        changeThmbnailElement.find('.button').css({
            'background-color': '#51EA2C',
            'border-color': '#51EA2C'
        });
        changeListElement.find('.button').css({
            'background-color': '#fff',
            'border-color': '#C4C4C4'
        });
        changeThmbnailElement.find('.thumbnail-icon').css('color', '#fff');
        changeListElement.find('.list-icon').css('color', '#F942F8');

        changeThmbnailElement.css('cursor', 'unset');
        changeListElement.css('cursor', 'pointer');
        listButtonElement.css('z-index', -1);
        thumbnailButtonElement.css('z-index', 1);
    } else {
        $('div.box.no-download').show();
        detailGallery.find('.wrapper').css('grid-template-columns', 'repeat(4, minmax(100px, 350px))');
        detailGallery.find('.icon-function-area, .description-content, .date-time-area').css('display', 'block');
        detailGallery.find('.content-container').css({
            'height': '450px',
            'border': '1px solid #F4F4F4'
        });
        detailGallery.find('.date-area, .thumbnail-row, .button-row').css('display', 'none');
        detailGallery.find('.top-content, .list-row').css('display', 'flex');

        changeThmbnailElement.css('cursor', 'pointer');
        changeListElement.css('cursor', 'unset');
        listButtonElement.css('z-index', 1);
        thumbnailButtonElement.css('z-index', -1);
        changeButtonStatus();
    }
}

var changeCheckbox = function () {
    $.each($("body").find("input[name='page']:checked"), function () {
        $(this).closest('label.select-menu-item').attr('aria-checked', 'true');
        $(this).closest('label.select-menu-item').find('.select-menu-item-icon').css('visibility', 'visible');
    });
    $.each($("body").find("input[name='page']:not(:checked)"), function () {
        console.log('false');
        $(this).closest('label.select-menu-item').attr('aria-checked', 'false');
        $(this).closest('label.select-menu-item').find('.select-menu-item-icon').css('visibility', 'hidden');
    });
}






