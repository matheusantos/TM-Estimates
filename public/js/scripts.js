$(document).ready(function() {
    var activeSystemClass = $('.list-group-item.active');

    //something is entered in search form
    $('#system-search').keyup( function() {
       var that = this;
        // affect all table rows on in systems table
        var tableBody = $('.table-list-search tbody');
        var tableRowsClass = $('.table-list-search tbody tr');
        $('.search-sf').remove();
        tableRowsClass.each( function(i, val) {
        
            //Lower text for case insensitive
            var rowText = $(val).text().toLowerCase();
            var inputText = $(that).val().toLowerCase();
            if(inputText != '')
            {
                $('.search-query-sf').remove();
                tableBody.prepend('<tr class="search-query-sf"><td colspan="6"><strong>Searching for: "'
                    + $(that).val()
                    + '"</strong></td></tr>');
            }
            else
            {
                $('.search-query-sf').remove();
            }

            if( rowText.indexOf( inputText ) == -1 )
            {
                //hide rows
                tableRowsClass.eq(i).hide();
                
            }
            else
            {
                $('.search-sf').remove();
                tableRowsClass.eq(i).show();
            }
        });
        //all tr elements are hidden
        if(tableRowsClass.children(':visible').length == 0)
        {
            tableBody.append('<tr class="search-sf"><td class="text-muted" colspan="6">No entries found.</td></tr>');
        }
    });
});

// Masked Input Plugin

jQuery(function($){
   $("#date").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
   $("#CPF").mask("999.999.999-99",{placeholder:"_"});
   $("#custo").mask("99.99");
   $("#tel").mask("(999) 999-9999");
   $("#cel").mask("(999) 999-9999");
   $("#rg").mask("99.999.999-9");
   $("#cep").mask("99.999-999");
   $("#cnpj").mask("99.999.999/9999-99");
  
});

//validar email
$(document).ready(function(){
   $("#form1").submit(function(){
      var email = $("#email").val();
      if(email != "")
      {
         var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
         if(filtro.test(email))
         {
	   alert("Este endereço de email é válido!");
	   return true;
         } else {
           alert("Este endereço de email não é válido!");
           return false;
         }
      } else {
	 alert('Digite um email!'); return false;
      }
   });
});