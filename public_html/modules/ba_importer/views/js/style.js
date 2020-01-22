/*
* 2007-2013 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author Buy-addons <contact@buy-addons.com>
*  @copyright  2007-2018 PrestaShop SA
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/
function check_identify_exiting(){
    return false;
}	$(document).ready(function(){    var height = $("#form_import").height();    $("#result").css("height",height+"px");        $("#mySelectBox").change(function(){        var value = $(this).val();        if(value == 1){            $("#form_import_ftp").fadeOut("slow");            $("#url_excel").fadeOut("slow");            $("#local_excel").fadeIn("slow");        }        if(value == 0){            $("#url_excel").fadeIn("slow");            $("#local_excel").fadeOut("slow");            $("#form_import_ftp").fadeOut("slow");        }                if(value == 2){            $("#form_import_ftp").fadeIn("slow");            $("#local_excel").fadeOut("slow");            $("#url_excel").fadeOut("slow");        }    });        $('#selector button').click(function() {        $('#selector button').addClass('active').not(this).removeClass('active');        /****TODO: insert whatever you want to do with $(this) here****/     });    $('#check_auto_import').click(function() {        if(document.getElementById('check_auto_import').checked) {            $("#btnNextStep").fadeIn("slow");        } else {            $("#btnNextStep").fadeOut("slow");        }    });	// $('#select_settings').change(function(){		// if($(this).val() == 'other'){			// $(".ba_an_other").css("display", "inline");		// } else {			// var value_setting = $(this).val();			// $(".ba_an_other").css("display", "none");			// document.getElementById("name_settings").value = "";			// jQuery.ajax({				// url		: base_url+'index.php?controller=ajaxsetting&fc=module&module=ba_importer',				// data	: '&value_setting='+value_setting,				// type	: 'POST',				// success: function(result){					// window.location.reload();				// }			// });		// }	// });    });function basubmitimport(){    if($('.name_setting').val() == ""){        $(".name_setting").css("border","1px solid red");        alert(alert_name_setting);        return false;    }    var characters_csv = $("#characters_csv").val();    if(characters_csv == ""){        $("#characters_csv").css("border","1px solid red");        return false;    }    var characters_category = $("#characters_category").val();    if(characters_category == ""){        $("#characters_category").css("border","1px solid red");        return false;    }    if(import_ftp.checked == true){        var ftp_server = $("#ftp_server").val();        if(ftp_server == ""){            $("#ftp_server").css("border","1px solid red");            return false;        }        var ftp_user_name = $("#ftp_user_name").val();        if(ftp_user_name == ""){            $("#ftp_user_name").css("border","1px solid red");            return false;        }        var ftp_user_pass = $("#ftp_user_pass").val();        if(ftp_user_pass == ""){            $("#ftp_user_pass").css("border","1px solid red");            return false;        }        var ftp_link_excel = $("#ftp_link_excel").val();        if(ftp_link_excel == ""){            $("#ftp_link_excel").css("border","1px solid red");            return false;        }    }    if(import_local_no.checked == true){        var link_excel = $("#link_excel").val();        if(link_excel == ""){            $("#link_excel").css("border","1px solid red");            return false;        }    }    /****File****/     var fileInput =  document.getElementById("exampleInputFile");    try{        var fileInput_filesize = fileInput.files[0].size; // Size returned in bytes.    }catch(e){        var objFSO = new ActiveXObject("Scripting.FileSystemObject");        var e = objFSO.getFile( fileInput.value);        var fileSize = e.size;        var fileInput_filesize = fileSize;        }    var get_upload_max_filesize = $("#get_upload_max_filesize").val();    if(fileInput_filesize>get_upload_max_filesize){        fileInput_filesize = formatNumber(fileInput_filesize);        get_upload_max_filesize = formatNumber(get_upload_max_filesize);        alert_over_max_file = alert_over_max_file.replace("*fileupload_filesize*", fileInput_filesize);        alert_over_max_file = alert_over_max_file.replace("*filemaxupload_filesize*", get_upload_max_filesize);        alert(alert_over_max_file);        return false;    }    /****IMG****/     var fileInputImg =  document.getElementById("exampleInputImg");    try{        var fileInput_filesizeImg = fileInputImg.files[0].size; // Size returned in bytes.    }catch(e){        var objFSO = new ActiveXObject("Scripting.FileSystemObject");        var e = objFSO.getFile( fileInputImg.value);        var fileSize = e.size;        var fileInput_filesizeImg = fileSize;        }    if(fileInput_filesizeImg>get_upload_max_filesize){        fileInput_filesizeImg = formatNumber(fileInput_filesizeImg);        get_upload_max_filesize = formatNumber(get_upload_max_filesize);        alert_over_max_file = alert_over_max_file.replace("*fileupload_filesize*", fileInput_filesizeImg);        alert_over_max_file = alert_over_max_file.replace("*filemaxupload_filesize*", get_upload_max_filesize);        alert(alert_over_max_file);        return false;    }    return true;}function formatNumber(number){    var number = number.toFixed(2) + '';    var x = number.split('.');    var x1 = x[0];    var x2 = x.length > 1 ? '.' + x[1] : '';    var rgx = /(\d+)(\d{3})/;    while (rgx.test(x1)) {        x1 = x1.replace(rgx, '$1' + ',' + '$2');    }    return x1 + x2;}
