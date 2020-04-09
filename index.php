<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="shortcut icon" href="https://www.acessohost.com.br/favicon/favicon.png" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/ui-lightness/jquery-ui-1.10.1.custom.min.css" rel="stylesheet" type="text/css"/>

        <title>Excel com PHP - utilizando spreedsheet</title>  
        <!--[if lt IE 9]>
            <script src="../_cdn/html5.js"></script> 
         <![endif]-->
        <!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,800' rel='stylesheet' type='text/css'>-->
    </head>
    <body>
        <!--HEADER-->
        <div class="container-fluid"> 
            <!--MENU BRAND-->   
            <div class="row">   
                <div class="col-md-12">  
                    <?php
                        echo "<p>São Paulo - ",getdate()['weekday'], ', ', getdate()['mday'], ' ', getdate()['month'], ' ', getdate()['year'], "</p>";
                    ?> 
                </div>
            </div>
        
            <!--FORMULARIO-->
            <div class="bg-info bottom20">
                <div class="col-md-12 bottom20 bg_red">
                    <p class="text-center"><i class="glyphicon glyphicon-check"></i> EXPORTAR PARA EXCEL <code>*por periodo</code></p>
                </div>    

                <form class="search" action="excel.php" method="POST"> 
                    <div class="col-md-12">
                        <label class="control-label"> <i class="glyphicon glyphicon-search"></i> Busca por Período <code>* Selecione sempre um período</code></label>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group bottom20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            <input type="text" name="data_inicial" class="form-control datepicker" value="" placeholder="Insira Data Inicial...">                                      
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group bottom20">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            <input type="text" name="data_final" class="form-control datepicker" value="" placeholder="Insira Data Final...">                                      
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="col-sm-12">
                        <button type="submit" class="btn btn-success submit" value="1" title="Pesquisar" name="submit"><i class="glyphicon glyphicon-search"></i> Pesquisar</button> 
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
        <script src="js/jquery.js"></script>
        <script src="js/jquery-ui-1.10.1.custom.min.js"></script>
        <script src="js/bootstrap.min.js"></script> 
        
        <script>
            $(function(){ 
                //Desabilita o auto-complete nos sistema
                $('input').attr('autocomplete','off');
                
                //DATAPICKER - ATUALIZANDO DIA
                var nomesMes = ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho', 'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                    nomesMesCurto = ['Jan','Fev','Mar','Abr','Mai','Jun', 'Jul','Ago','Set','Out','Nov','Dez'],
                    nomesDia = ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sabado'],
                    nomesDiaCurto = ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'];
                
                 //DATAPICKER
                $.datepicker.regional['pt-BR'] = {
                closeText: 'Fechar',
                prevText: '&#x3c;Anterior',
                nextText: 'Pr&oacute;ximo&#x3e;',
                currentText: 'Hoje',
                monthNames: ['Janeiro','Fevereiro','Mar&ccedil;o','Abril','Maio','Junho',
                'Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun',
                'Jul','Ago','Set','Out','Nov','Dez'],
                dayNames: ['Domingo','Segunda-feira','Ter&ccedil;a-feira','Quarta-feira','Quinta-feira','Sexta-feira','Sabado'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],
                dayNamesMin: ['Dom','Seg','Ter','Qua','Qui','Sex','Sab'],  
                weekHeader: 'Sm',
                dateFormat: 'dd/mm/yy', 
                firstDay: 0,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''};
                $.datepicker.setDefaults($.datepicker.regional['pt-BR']);
                $(".datepicker").datepicker({dateFormat: 'dd/mm/yy'});
                
                //Validando form
                $("form.search").on("submit", function(){
                    //Window.setTimeout(function(){
                    $(".submit").html("<img src='images/load.gif'/>");
                    //}, 3000); 
                }); 
            });//Seletor Jquery
        </script>
    </body>
</html>