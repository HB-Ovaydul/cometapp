/*
Author       : Dreamguys
Template Name: Doccure - Bootstrap Admin Template
Version      : 1.0
*/

(function($) {
    "use strict";
	
	// Variables declarations
	
	var $wrapper = $('.main-wrapper');
	var $pageWrapper = $('.page-wrapper');
	var $slimScrolls = $('.slimscroll');
	
	// Sidebar
	
	var Sidemenu = function() {
		this.$menuItem = $('#sidebar-menu a');
	};
	
	function init() {
		var $this = Sidemenu;
		$('#sidebar-menu a').on('click', function(e) {
			if($(this).parent().hasClass('submenu')) {
				e.preventDefault();
			}
			if(!$(this).hasClass('subdrop')) {
				$('ul', $(this).parents('ul:first')).slideUp(350);
				$('a', $(this).parents('ul:first')).removeClass('subdrop');
				$(this).next('ul').slideDown(350);
				$(this).addClass('subdrop');
			} else if($(this).hasClass('subdrop')) {
				$(this).removeClass('subdrop');
				$(this).next('ul').slideUp(350);
			}
		});
		$('#sidebar-menu ul li.submenu a.active').parents('li:last').children('a:first').addClass('active').trigger('click');
	}
	
	// Sidebar Initiate
	init();
	
	// Mobile menu sidebar overlay
	
	$('body').append('<div class="sidebar-overlay"></div>');
	$(document).on('click', '#mobile_btn', function() {
		$wrapper.toggleClass('slide-nav');
		$('.sidebar-overlay').toggleClass('opened');
		$('html').addClass('menu-opened');
		return false;
	});
	
	// Sidebar overlay
	
	$(".sidebar-overlay").on("click", function () {
		$wrapper.removeClass('slide-nav');
		$(".sidebar-overlay").removeClass("opened");
		$('html').removeClass('menu-opened');
	});
	
	// Page Content Height
	
	if($('.page-wrapper').length > 0 ){
		var height = $(window).height();	
		$(".page-wrapper").css("min-height", height);
	}
	
	// Page Content Height Resize
	
	$(window).resize(function(){
		if($('.page-wrapper').length > 0 ){
			var height = $(window).height();
			$(".page-wrapper").css("min-height", height);
		}
	});
	
	// Select 2
	
    if ($('.select').length > 0) {
        $('.select').select2({
            minimumResultsForSearch: -1,
            width: '100%'
        });
    }
	
	// Datetimepicker
	
	if($('.datetimepicker').length > 0 ){
		$('.datetimepicker').datetimepicker({
			format: 'DD/MM/YYYY',
			icons: {
				up: "fa fa-angle-up",
				down: "fa fa-angle-down",
				next: 'fa fa-angle-right',
				previous: 'fa fa-angle-left'
			}
		});
		$('.datetimepicker').on('dp.show',function() {
			$(this).closest('.table-responsive').removeClass('table-responsive').addClass('temp');
		}).on('dp.hide',function() {
			$(this).closest('.temp').addClass('table-responsive').removeClass('temp')
		});
	}

	// Tooltip
	
	if($('[data-toggle="tooltip"]').length > 0 ){
		$('[data-toggle="tooltip"]').tooltip();
	}
	
    // Datatable

    if ($('.datatable').length > 0) {
        $('.datatable').DataTable({
            "bFilter": false,
        });
    }
	
	// Email Inbox

	if($('.clickable-row').length > 0 ){
		$(document).on('click', '.clickable-row', function() {
			window.location = $(this).data("href");
		});
	}

	// Check all email
	
	$(document).on('click', '#check_all', function() {
		$('.checkmail').click();
		return false;
	});
	if($('.checkmail').length > 0) {
		$('.checkmail').each(function() {
			$(this).on('click', function() {
				if($(this).closest('tr').hasClass('checked')) {
					$(this).closest('tr').removeClass('checked');
				} else {
					$(this).closest('tr').addClass('checked');
				}
			});
		});
	}
	
	// Mail important
	
	$(document).on('click', '.mail-important', function() {
		$(this).find('i.fa').toggleClass('fa-star').toggleClass('fa-star-o');
	});
	
	// Summernote
	
	if($('.summernote').length > 0) {
		$('.summernote').summernote({
			height: 200,                 // set editor height
			minHeight: null,             // set minimum height of editor
			maxHeight: null,             // set maximum height of editor
			focus: false                 // set focus to editable area after initializing summernote
		});
	}
	
    // Product thumb images

    if ($('.proimage-thumb li a').length > 0) {
        var full_image = $(this).attr("href");
        $(".proimage-thumb li a").click(function() {
            full_image = $(this).attr("href");
            $(".pro-image img").attr("src", full_image);
            $(".pro-image img").parent().attr("href", full_image);
            return false;
        });
    }

    // Lightgallery

    if ($('#pro_popup').length > 0) {
        $('#pro_popup').lightGallery({
            thumbnail: true,
            selector: 'a'
        });
    }
	
	// Sidebar Slimscroll

	if($slimScrolls.length > 0) {
		$slimScrolls.slimScroll({
			height: 'auto',
			width: '100%',
			position: 'right',
			size: '7px',
			color: '#ccc',
			allowPageScroll: false,
			wheelStep: 10,
			touchScrollStep: 100
		});
		var wHeight = $(window).height() - 60;
		$slimScrolls.height(wHeight);
		$('.sidebar .slimScrollDiv').height(wHeight);
		$(window).resize(function() {
			var rHeight = $(window).height() - 60;
			$slimScrolls.height(rHeight);
			$('.sidebar .slimScrollDiv').height(rHeight);
		});
	}
	
	// Small Sidebar

	$(document).on('click', '#toggle_btn', function() {
		if($('body').hasClass('mini-sidebar')) {
			$('body').removeClass('mini-sidebar');
			$('.subdrop + ul').slideDown();
		} else {
			$('body').addClass('mini-sidebar');
			$('.subdrop + ul').slideUp();
		}
		setTimeout(function(){ 
			mA.redraw();
			mL.redraw();
		}, 300);
		return false;
	});
	$(document).on('mouseover', function(e) {
		e.stopPropagation();
		if($('body').hasClass('mini-sidebar') && $('#toggle_btn').is(':visible')) {
			var targ = $(e.target).closest('.sidebar').length;
			if(targ) {
				$('body').addClass('expand-menu');
				$('.subdrop + ul').slideDown();
			} else {
				$('body').removeClass('expand-menu');
				$('.subdrop + ul').slideUp();
			}
			return false;
		}
	});

// My javascript
// Alert
    $('.delete').click(function(){
        let conf = confirm('Are you Sure?')
		if(conf){
			return true;
		}else{
			return false;
		}
    });

// Datatable
$(document).ready(function(){
	$('.data-table-ov').DataTable();
});

// Slider Photo management 
$('#slider-photo').change(function(e){
	const photo_url = URL.createObjectURL(e.target.files[0]);
	$('#slide-photo-preview').attr('src', photo_url);
});

// Slider Photo management 
$('#new-photo').change(function(e){
	const photo_url = URL.createObjectURL(e.target.files[0]);
	$('#slide-photo-preview').attr('src', photo_url);

});

// Button Management
let btn_no = 1;
$('#add-slide-preview-option').click(function(e){
	e.preventDefault();
	$('.btn-slide-option').append(`
			<div class="btn-slider-area">
			<span>Button#${btn_no}<span>
			<span style="margin-left:390px;cursor:pointer;" class="badge badge-danger button-romove">Remove</span>
			<input name="btn_title[]" class="form-control" type="text" id="" placeholder="Button Title">
			<input name="btn_link[]" class="form-control" type="text" id="" placeholder="Button link">
			<label>
				<select class="form-control select" name="btn_type[]">
					<option value="btn btn-color">Default</option>
					<option value="btn btn-light-out">Red</option>
				</select>
			</label>
    		</div>
	`);
	btn_no++;
});

//Button Remove
$(document).on('click', '.button-romove',function(){
	
	$(this).closest('.btn-slider-area').remove();
});

// Modeal icon

$('button.btn-select-modal').click(function(e){
	e.preventDefault();
	$('#select-icon').modal('show');
});

$('.mod-font-select-icon .preview-icon code').click(function(){
	
	let icon = $(this).html();
	let icons =$('.ov-icon-select').val(icon);
	$('#select-icon').modal('hide');
});

// Espertise Pohoto preview

$('#photo-id').change(function(e){
	let url = URL.createObjectURL(e.target.files[0]);
	$('#photo-preview').attr('src', url);
});

// The Vision photo view
$('#photo_id').change(function(e){
	let urls = URL.createObjectURL(e.target.files[0]);
	$('#photo_viwe').attr('src', urls);
});

// CKeditor
CKEDITOR.replace( 'portfolio_desc' );

// Multiple Gallery image
$('#gallery').change(function(e){
	const files = e.target.files;
	let galler_file = '';
	for(let i = 0; i < files.length; i++){
		const object_file = URL.createObjectURL(files[i]);
		galler_file += `<img src="${ object_file }">`;	
	}
	$('.preview-gallery').html(galler_file);
});

// Select 2 for Tag
$('.comet-select').select2();

// Blog featuer
$('#comet-blog').change(function(){
	const type = $(this).val();
	if(type == 'Standard'){
		$('.post-standard').show();
		$('.post-gallery').hide();
		$('.post-video').hide();
		$('.post-audio').hide();
		$('.post-qoute').hide();
	}else if(type == 'Gallery'){
		$('.post-standard').hide();
		$('.post-gallery').show();
		$('.post-video').hide();
		$('.post-audio').hide();
		$('.post-qoute').hide();
	}else if(type == 'Video'){
		$('.post-standard').hide();
		$('.post-gallery').hide();
		$('.post-video').show();
		$('.post-audio').hide();
		$('.post-qoute').hide();
	}else if(type == 'Audio'){
		$('.post-standard').hide();
		$('.post-gallery').hide();
		$('.post-video').hide();
		$('.post-audio').show();
		$('.post-qoute').hide();
	}else if(type == 'Qoute'){
		$('.post-standard').hide();
		$('.post-gallery').hide();
		$('.post-video').hide();
		$('.post-audio').hide();
		$('.post-qoute').show();
	}
});



})(jQuery);
