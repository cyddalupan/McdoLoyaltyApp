$("input[rel*='date']")
  .datepicker({dateFormat: "dd-M-yy"})
  .wrap('<div class="input-append" />')
  .attr("readonly",true)
  .after($('<button class="btn"><i class="icon icon-calendar" /></button>')
  .click(function(){$(this).parent().parent().children().first().focus()}));

$("input[rel*='date-advanced']")
  .parent().children().last()
  .wrap($('<div class="btn-group" />'))
  .before('<button class="btn dropdown-toggle" style="border-radius:0 !important;" data-toggle="dropdown"><span class="caret"></span></button>')
  .before($('<ul class="dropdown-menu" role="menu"><li data-increment="1"><a>In a month</a></li><li data-increment="3"><a>In 3 months</a></li><li data-increment="6"><a>Within 6 months</a></li><li data-increment="12"><a>In a year</a></li></ul>').on('click', 'li', function(){$(this).closest('.input-append').children().first().val(new Date((new Date().setMonth(new Date().getMonth()+$(this).data('increment')))).toUTCString().substring(5,16).replace(/ /g,"-"))})
);