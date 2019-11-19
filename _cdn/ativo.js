/*$(function () {
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        language: 'pt-BR'
    });
});*/

document.addEventListener('invalid', function(e){
   $(e.target).addClass("invalid");
   $('html, body').animate({scrollTop: $($(".invalid")[0]).offset().top - offset }, delay);
}, true);
document.addEventListener('change', function(e){
   $(e.target).removeClass("invalid")
}, true);

//esconde popover
$(document).on('click', function (e) {
    $('[data-toggle="popover"],[data-original-title]').each(function () {
        //the 'is' for buttons that trigger popups
        //the 'has' for icons within a button that triggers a popup
        if (!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
            (($(this).popover('hide').data('bs.popover')||{}).inState||{}).click = false  // fix for BS 3.3.6
        }

    });
});
$(document).ready(function () {

    $.summernote.dom.emptyPara = "<div><br/></div>";

    $('textarea').summernote({
        lang: 'pt-BR',
        enterHtml: '<p><br></p>',
        toolbar: [
            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'clear'] ],
            [ 'para', [ 'ol', 'ul' ] ],
            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview'] ]
        ]
    });

    $('input.note-image-input').remove();

    //exibe popover
    $('[data-toggle="popover"]').popover({
        container: 'body'
    });

    //FORÇA UPPERCASE NO SISTEMA TODO
    $(':input[type=text]').keyup(function() {
      this.value = this.value.toUpperCase();
    });

    //MASCARAS

    //CEP
    $('.i-cpf').mask(cpfMascara, cpfOptions);
    $('input[name=cpf_cnpj]').mask(cpfMascara, cpfOptions);
	$('input[name=cnpj]').mask(cpfMascara, cpfOptions);
    $('.i-cpf').attr('minlength','14');
    $('input[name=cpf_cnpj]').attr('minlength','14');
	$('input[name=cnpj]').attr('minlength','14');
    //----------------------------------------------

    //TELEFONE
    var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    spOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };
    $('.i-fone').mask(SPMaskBehavior, spOptions);
    $('.i-fone').attr('minlength','14');
    //----------------------------------------------

    //CPF CNPJ
    var cpfMascara = function (val) {
       return val.replace(/\D/g, '').length > 11 ? '00.000.000/0000-00' : '000.000.000-009';
    },
    cpfOptions = {
       onKeyPress: function(val, e, field, options) {
          field.mask(cpfMascara.apply({}, arguments), options);
       }
    };
    $('.i-cpf').mask(cpfMascara, cpfOptions);
    $('input[name=cpf_cnpj]').mask(cpfMascara, cpfOptions);
    $('.i-cpf').attr('minlength','14');
    $('input[name=cpf_cnpj]').attr('minlength','14');
    //----------------------------------------------

    //PLACA
    $('input[name=placa]').mask('SSS0A00', {'translation': {A: {pattern: /[A-Za-z0-9]/}}});
    $('input[name=placa]').keyup(function() {
      this.value = this.value.toUpperCase();
    });
    //----------------------------------------------

    //FIM MASCARAS

	$(".clickable-row").click(function () {
        window.location = $(this).data("href");
    });

	$.fn.dataTable.ext.errMode = 'none';

	$(".tablesorter").DataTable({
        "order": [[ 0, 'asc' ]],
		"language": {
		"decimal":        "",
		"emptyTable":     "Sem resultados",
		"info":           "Mostrando _START_ à _END_ de _TOTAL_ resultados",
		"infoEmpty":      "Mostrando 0 à 0 de 0 resultados",
		"infoFiltered":   "(filtrados de _MAX_ resultados totais)",
		"infoPostFix":    "",
		"thousands":      ",",
		"lengthMenu":     "Mostre _MENU_ resultados",
		"loadingRecords": "Carregando...",
		"processing":     "Processando...",
		"search":         "Pesquisa:",
		"zeroRecords":    "Nenhum resultado encontrado",
		"paginate": {
			"first":      "Primeira",
			"last":       "Última",
			"next":       "Próxima",
			"previous":   "Anterior"
		},
		"aria": {
			"sortAscending":  ": active para ordenar a coluna ascendente",
			"sortDescending": ": active para ordenar a coluna descendente"
		}
	}
	} );

    $(".tablesorter-d").DataTable({
        "order": [[ 0, 'desc' ]],
        "language": {
        "decimal":        "",
        "emptyTable":     "Sem resultados",
        "info":           "Mostrando _START_ à _END_ de _TOTAL_ resultados",
        "infoEmpty":      "Mostrando 0 à 0 de 0 resultados",
        "infoFiltered":   "(filtrados de _MAX_ resultados totais)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "Mostre _MENU_ resultados",
        "loadingRecords": "Carregando...",
        "processing":     "Processando...",
        "search":         "Pesquisa:",
        "zeroRecords":    "Nenhum resultado encontrado",
        "paginate": {
            "first":      "Primeira",
            "last":       "Última",
            "next":       "Próxima",
            "previous":   "Anterior"
        },
        "aria": {
            "sortAscending":  ": active para ordenar a coluna ascendente",
            "sortDescending": ": active para ordenar a coluna descendente"
        }
    }
    } );

    $(".tablesorter-50").DataTable({
        "order": [[ 0, 'desc' ]],
        "pageLength": 100,
        "language": {
        "decimal":        "",
        "emptyTable":     "Sem resultados",
        "info":           "Mostrando _START_ à _END_ de _TOTAL_ resultados",
        "infoEmpty":      "Mostrando 0 à 0 de 0 resultados",
        "infoFiltered":   "(filtrados de _MAX_ resultados totais)",
        "infoPostFix":    "",
        "thousands":      ",",
        "lengthMenu":     "Mostre _MENU_ resultados",
        "loadingRecords": "Carregando...",
        "processing":     "Processando...",
        "search":         "Pesquisa:",
        "zeroRecords":    "Nenhum resultado encontrado",
        "paginate": {
            "first":      "Primeira",
            "last":       "Última",
            "next":       "Próxima",
            "previous":   "Anterior"
        },
        "aria": {
            "sortAscending":  ": active para ordenar a coluna ascendente",
            "sortDescending": ": active para ordenar a coluna descendente"
        }
    }
    } );

    //SELECT COM PESQUISA
    var url = window.location.href;

    if( url.includes('cad_') || url.includes('edita_') || url.includes('ger_recibo') || url.includes('ger_despesa') ){
        $("select:not(.select_normal)").select2({
            "language": {
               "noResults": function(){
                   return "Nenhum resultado encontrado.";
               }
           },
            escapeMarkup: function (markup) {
                return markup;
            }
        });
    }


});
