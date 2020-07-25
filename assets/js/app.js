// TYNYMCE
// CDN <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=b4tpr3u5rzqh58sg99vmmi45zswzdicshnnsc2rv8oyop1fm"></script>
/*
tinymce.init({
    selector:'.tinymce'
});
*/
tinymce.init({
    selector : ".tinymce",
    plugins: [
        "advlist autolink lists link charmap print preview anchor textcolor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime table contextmenu paste textcolor",
        "autoresize"
    ],
    autoresize_bottom_margin: 20,
    toolbar: "insertfile undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor",
    formats: {
        alignleft: {
            inline: 'span',
            styles: {
                display: 'block',
                textAlign: 'left'
            }
        },
        aligncenter: {
            inline: 'span',
            styles: {
                display: 'block',
                textAlign: 'center'
            }
        },
        alignright: {
            inline: 'span',
            styles: {
                display: 'block',
                textAlign: 'right'
            }
        },
        alignjustify: {
            inline: 'span',
            styles: {
                display: 'block',
                textAlign: 'justify'
            }
        },
    }
});

// CKEDITOR
// CDN <script src="//cdn.ckeditor.com/4.11.1/full/ckeditor.js"></script>
// CKEDITOR.replace('ckeditor');

// SHOW OR HIDE PASSWORD
$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        const input = $('#show_hide_password input');
        const i = $('#show_hide_password i');
        if(input.attr("type") === "text"){
            input.attr('type', 'password');
            i.removeClass( "fa-eye" );
            i.addClass( "fa-eye-slash" );
        }else if(input.attr("type") === "password"){
            input.attr('type', 'text');
            i.removeClass( "fa-eye-slash" );
            i.addClass( "fa-eye" );
        }
    });
});

// FOR THE UPLOAD BUTTON
'use strict';
( function ( document, window, index )
{
    const inputs = document.querySelectorAll('.upload');
    Array.prototype.forEach.call( inputs, function( input )
    {
        const label	 = input.previousElementSibling,
            labelVal = label.innerHTML;

        input.addEventListener( 'change', function( e )
        {
            let fileName = '';
            if( this.files && this.files.length > 1 )
                fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
            else
                fileName = e.target.value.split( '\\' ).pop();

            if( fileName )
                label.querySelector( 'span' ).innerHTML = fileName;
            else
                label.innerHTML = labelVal;
        });

        // Firefox bug fix
        input.addEventListener( 'focus', function(){ input.classList.add( 'has-focus' ); });
        input.addEventListener( 'blur', function(){ input.classList.remove( 'has-focus' ); });
    });
}( document, window, 0 ));

// CLASS TO CONFIRM A DANGEROUS ACTION ON A LINK
$(function() {
    $('.js-confirm-link').click(function(e) {
        e.preventDefault();
        if (window.confirm("Etes-vous sûr d'effectuer cette action ? Les données supprimées ne pourront être récupérées !")) {
            location.href = this.href;
        }
    });
});
// or with a beautiful modal
$(function() {
    $('.js-confirm-modal').click(function(e) {
        e.preventDefault();
        const href = $(e.currentTarget).attr("href");
        $("#js-confirm-modal").find("a").first().attr("href", href);
    });
});

// CLASS TO CONFIRM A DANGEROUS ACTION ON A FORM
$(function() {
    $('.js-confirm-form').submit(function(e) {
        e.preventDefault();
        if (window.confirm("Etes-vous sûr d'effectuer cette action ? Les données supprimées ne pourront être récupérées !")) {
            this.submit();
        }
    });
});

// SCROLLPSY / ANCHOR / GO TO ID
$('.js-scrollTo').click(function() {
    const page = $(this).attr('href');
    const speed = 1250;
    $('html, body').animate( { scrollTop: $(page).offset().top }, speed );
});

// DISPLAY MEDIAS AND HIDE BUTTON
$(document).ready(function () {
    $("#seeMediasTrick").on('click', function (event) {
        event.preventDefault();
        const a = $('#seeMediasTrick');
        const medias = $('#mediasTrick');
        a.hide();
        medias.removeAttr('id');
    });
});

// ************************************************** PROJET 6 ************************************************** //
// LOAD MORE TRICKS HOMEPAGE
let btnLoadMoreTricks = $("#loadMoreTricks");
let numPageTricks = 2;
btnLoadMoreTricks.click(function(e) {
    e.preventDefault();

    let xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            $("#tricks").append(this.responseText);
        }
    };

    xmlHttp.open("GET", "/ajax-load-tricks/" + numPageTricks);
    xmlHttp.send();

    numPageTricks += 1;

    if (numPageTricks > btnLoadMoreTricks.data("nbpagestot")) {
        btnLoadMoreTricks.prop("hidden", true);
    }
});

// LOAD MORE COMMENTS TRICKS DETAILS
let btnLoadMoreComments = $("#loadMoreComments");
let numPageComments = 2;
btnLoadMoreComments.click(function(e) {
    e.preventDefault();

    let xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            $("#comments").append(this.responseText);
        }
    };

    xmlHttp.open("GET", "/ajax-load-comments/" + btnLoadMoreComments.data("slug") + "/" + numPageComments);
    xmlHttp.send();

    numPageComments += 1;

    if (numPageComments > btnLoadMoreComments.data("nbpagestot")) {
        btnLoadMoreComments.prop("hidden", true);
    }
});

// UNCHECK CHECKBOX CHECKED
$(".images").click(function(e) {
    if ($(e.target).is(":checkbox")) {
        let idTarget = $(e.target).attr('id');
        let checkBoxS = $(":checkbox");

        $.each(checkBoxS, function () {
            if (idTarget !== $(this).attr('id')) {
                $(this).prop('checked', false);
            }
        });
    }
});

// MANAGE COLLECTIONTYPES & PROTOTYPES
/****************************************************************************************************/
/************************************* COLLECTION OF LINKS ******************************************/
/****************************************************************************************************/
var collectionHolderLinks;

// setup an "add a media" link
var addLinksBtn =
    $("<button type='button' class='btn btn-outline-danger waves-effect px-3 add_links_link'>" +
        "<i class=\"fab fa-2x fa-youtube\"></i>" +
        "</button>");

// how could be the li with which class
var myLiStyleLinks = "<li class='list-group-item'></li>";

var newLinkLiLinks = $(myLiStyleLinks).append(addLinksBtn);

jQuery(document).ready(function () {
    // get the ul that holds the collection of tags
    collectionHolderLinks = $("ul.links");

    // add a delete link to all of the existing tag form li elements
    collectionHolderLinks.find('li').each(function() {
        addDeleteLinks($(this));
    });

    // add the "add a media" anchor and li to the medias ul
    collectionHolderLinks.append(newLinkLiLinks);

    // count the current form inputs we have, use that as the new index when inserting a new item
    collectionHolderLinks.data("index", collectionHolderLinks.find(":input").length);

    addLinksBtn.on("click", function (e) {
        // add a new media form
        addMediaFormLinks(collectionHolderLinks, newLinkLiLinks);
    });

    function addMediaFormLinks(collectionHolderLinks, newLinkLiLinks) {
        // get the data prototype
        var prototypeLinks = collectionHolderLinks.data("prototype-links");

        // get the new index
        var indexLinks = collectionHolderLinks.data("index");

        var newFormLinks = prototypeLinks;

        // you need this only if you didn't set "label" => false in your medias field in the type
        // replace "__name__label__" in the prototype's html to instead be a number based on how many items we have
        // => newForm = newForm.replace(/__name__label__/g, index);

        // replace "__name__" in the prototype's html to instead be a number based on how many items we have
        newFormLinks = newFormLinks.replace(/__name__/g, indexLinks);

        // increase the index with one for the next item
        collectionHolderLinks.data("index", indexLinks+1);

        // display the form in the page in an li, before the "add a media" link li
        var newFormLiLinks = $(myLiStyleLinks).append(newFormLinks);
        newLinkLiLinks.before(newFormLiLinks);

        // add a delete link to the new form
        addDeleteLinks(newFormLiLinks);
    }

    function addDeleteLinks($liLinks) {
        var $removeButtonLinks = $('<button type="button" class="btn btn-outline-warning py-0 px-1">' +
            '   <i class="fas fa-times"></i>' +
            '</button>');
        $liLinks.prepend($removeButtonLinks);

        $removeButtonLinks.on('click', function(e) {
            // remove the li for the tag form
            $liLinks.remove();
        });
    }
});

/****************************************************************************************************/
/************************************ COLLECTION OF IMAGES ******************************************/
/****************************************************************************************************/
var collectionHolderImages;

// setup an "add a media" link
var addImagesBtn =
    $("<button type='button' class='btn btn-outline-info waves-effect px-3 add_images_link'>" +
        "<i class=\"far fa-2x fa-file-image\"></i>" +
        "</button>");

// how could be the li with which class
var myLiStyleImages = "<li class='list-group-item'></li>";

var newLinkLiImages = $(myLiStyleImages).append(addImagesBtn);

jQuery(document).ready(function () {
    // get the ul that holds the collection of tags
    collectionHolderImages = $("ul.images");

    // add a delete link to all of the existing tag form li elements
    collectionHolderImages.find('li').each(function() {
        addDeleteImages($(this));
    });

    // add the "add a media" anchor and li to the medias ul
    collectionHolderImages.append(newLinkLiImages);

    // count the current form inputs we have, use that as the new index when inserting a new item
    collectionHolderImages.data("index", collectionHolderImages.find(":input").length);

    addImagesBtn.on("click", function (e) {
        // add a new media form
        addMediaFormImages(collectionHolderImages, newLinkLiImages);
    });

    function addMediaFormImages(collectionHolderImages, newLinkLiImages) {
        // get the data prototype
        var prototypeImages = collectionHolderImages.data("prototype-images");

        // get the new index
        var indexImages = collectionHolderImages.data("index");

        var newFormImages = prototypeImages;

        // you need this only if you didn't set "label" => false in your medias field in the type
        // replace "__name__label__" in the prototype's html to instead be a number based on how many items we have
        // => newForm = newForm.replace(/__name__label__/g, index);

        // replace "__name__" in the prototype's html to instead be a number based on how many items we have
        newFormImages = newFormImages.replace(/__name__/g, indexImages);

        // increase the index with one for the next item
        collectionHolderImages.data("index", indexImages+1);

        // display the form in the page in an li, before the "add a media" link li
        var newFormLiImages = $(myLiStyleImages).append(newFormImages);

        newLinkLiImages.before(newFormLiImages);

        // add a delete link to the new form
        addDeleteImages(newFormLiImages);
    }

    function addDeleteImages($liImages) {
        var $removeButtonImages = $('<button type="button" class="btn btn-outline-warning py-0 px-1">' +
            '   <i class="fas fa-times"></i>' +
            '</button>');
        $liImages.prepend($removeButtonImages);

        $removeButtonImages.on('click', function(e) {
            // remove the li for the tag form
            $liImages.remove();
        });
    }
});
/****************************************************************************************************/
/****************************************************************************************************/