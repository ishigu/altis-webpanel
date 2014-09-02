


/*=============================================================
    Authour URI: www.binarycart.com
    License: Commons Attribution 3.0

    http://creativecommons.org/licenses/by/3.0/

    100% To use For Personal And Commercial Use.
    IN EXCHANGE JUST GIVE US CREDITS AND TELL YOUR FRIENDS ABOUT US
   
    ========================================================  */


(function ($) {
    "use strict";
    var mainApp = {

        main_fun: function () {
            /*====================================
            METIS MENU 
            ======================================*/
            $('#main-menu').metisMenu();

            /*====================================
              LOAD APPROPRIATE MENU BAR
           ======================================*/
            $(window).bind("load resize", function () {
                if ($(this).width() < 768) {
                    $('div.sidebar-collapse').addClass('collapse')
                } else {
                    $('div.sidebar-collapse').removeClass('collapse')
                }
            });

            /*====================================
            MORRIS BAR CHART
         ======================================*/
            Morris.Bar({
                element: 'morris-bar-chart',
                data: [{
                    y: '2006',
                    a: 100,
                    b: 90
                }, {
                    y: '2007',
                    a: 75,
                    b: 65
                }, {
                    y: '2008',
                    a: 50,
                    b: 40
                }, {
                    y: '2009',
                    a: 75,
                    b: 65
                }, {
                    y: '2010',
                    a: 50,
                    b: 40
                }, {
                    y: '2011',
                    a: 75,
                    b: 65
                }, {
                    y: '2012',
                    a: 100,
                    b: 90
                }],
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Series A', 'Series B'],
                hideHover: 'auto',
                resize: true
            });

            /*====================================
          MORRIS DONUT CHART
       ======================================*/
            Morris.Donut({
                element: 'morris-donut-chart',
                data: [{
                    label: "Download Sales",
                    value: 12
                }, {
                    label: "In-Store Sales",
                    value: 30
                }, {
                    label: "Mail-Order Sales",
                    value: 20
                }],
                resize: true
            });

            /*====================================
         MORRIS AREA CHART
      ======================================*/

            Morris.Area({
                element: 'morris-area-chart',
                data: [{
                    period: '2010 Q1',
                    iphone: 2666,
                    ipad: null,
                    itouch: 2647
                }, {
                    period: '2010 Q2',
                    iphone: 2778,
                    ipad: 2294,
                    itouch: 2441
                }, {
                    period: '2010 Q3',
                    iphone: 4912,
                    ipad: 1969,
                    itouch: 2501
                }, {
                    period: '2010 Q4',
                    iphone: 3767,
                    ipad: 3597,
                    itouch: 5689
                }, {
                    period: '2011 Q1',
                    iphone: 6810,
                    ipad: 1914,
                    itouch: 2293
                }, {
                    period: '2011 Q2',
                    iphone: 5670,
                    ipad: 4293,
                    itouch: 1881
                }, {
                    period: '2011 Q3',
                    iphone: 4820,
                    ipad: 3795,
                    itouch: 1588
                }, {
                    period: '2011 Q4',
                    iphone: 15073,
                    ipad: 5967,
                    itouch: 5175
                }, {
                    period: '2012 Q1',
                    iphone: 10687,
                    ipad: 4460,
                    itouch: 2028
                }, {
                    period: '2012 Q2',
                    iphone: 8432,
                    ipad: 5713,
                    itouch: 1791
                }],
                xkey: 'period',
                ykeys: ['iphone', 'ipad', 'itouch'],
                labels: ['iPhone', 'iPad', 'iPod Touch'],
                pointSize: 2,
                hideHover: 'auto',
                resize: true
            });

            /*====================================
    MORRIS LINE CHART
 ======================================*/
            Morris.Line({
                element: 'morris-line-chart',
                data: [{
                    y: '2006',
                    a: 100,
                    b: 90
                }, {
                    y: '2007',
                    a: 75,
                    b: 65
                }, {
                    y: '2008',
                    a: 50,
                    b: 40
                }, {
                    y: '2009',
                    a: 75,
                    b: 65
                }, {
                    y: '2010',
                    a: 50,
                    b: 40
                }, {
                    y: '2011',
                    a: 75,
                    b: 65
                }, {
                    y: '2012',
                    a: 100,
                    b: 90
                }],
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Series A', 'Series B'],
                hideHover: 'auto',
                resize: true
            });
           
     
        },

        initialization: function () {
            mainApp.main_fun();

        }

    }
    // Initializing ///

    $(document).ready(function () {
        mainApp.main_fun();
    });

}(jQuery));

// Dynamic Modals
// Vehicles
$('#vehModal').on('show.bs.modal', function(e) {
    //get data-id attribute of the clicked element
    var vehId = $(e.relatedTarget).data('id');

    //populate the textbox
    $(e.currentTarget).find('#vehForm').load("index.php?page=ajax&action=editVehicle&id=" + vehId);
});
$("#vehSend").click(function()
{
    $("#vehFormForm").submit(function(e)
    {
        $("#vehForm").html("<img src='theme/binary/img/loading.gif'/>");
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax(
        {
            url : formURL,
            type: "POST",
            data : postData,
            success:function(data, textStatus, jqXHR) 
            {
                $("#vehForm").html('<pre>Erfolgreich! Ge&auml;nderte Datens&auml;tze: '+data+'</pre>');
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
                $("#vehForm").html('<pre>AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</pre>');
            }
        });
        e.preventDefault();	//STOP default action
    });

    $("#vehFormForm").submit(); //SUBMIT FORM
});

// Gangs
$('#gangModal').on('show.bs.modal', function(e) {
    //get data-id attribute of the clicked element
    var gangId = $(e.relatedTarget).data('id');

    //populate the textbox
    $(e.currentTarget).find('#gangForm').load("index.php?page=ajax&action=editGang&id=" + gangId);
});
$("#gangSend").click(function()
{
    $("#gangFormForm").submit(function(e)
    {
        $("#gangForm").html("<img src='theme/binary/img/loading.gif'/>");
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax(
        {
            url : formURL,
            type: "POST",
            data : postData,
            success:function(data, textStatus, jqXHR) 
            {
                $("#gangForm").html('<pre>Erfolgreich! Ge&auml;nderte Datens&auml;tze: '+data+'</pre>');
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
                $("#gangForm").html('<pre>AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</pre>');
            }
        });
        e.preventDefault();	//STOP default action
    });

    $("#gangFormForm").submit(); //SUBMIT FORM
});

// Houses
$('#houseModal').on('show.bs.modal', function(e) {
    //get data-id attribute of the clicked element
    var houseId = $(e.relatedTarget).data('id');

    //populate the textbox
    $(e.currentTarget).find('#houseForm').load("index.php?page=ajax&action=editHouse&id=" + houseId);
});
$("#houseSend").click(function()
{
    $("#houseFormForm").submit(function(e)
    {
        $("#houseForm").html("<img src='theme/binary/img/loading.gif'/>");
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax(
        {
            url : formURL,
            type: "POST",
            data : postData,
            success:function(data, textStatus, jqXHR) 
            {
                $("#houseForm").html('<pre>Erfolgreich! Ge&auml;nderte Datens&auml;tze: '+data+'</pre>');
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
                $("#houseForm").html('<pre>AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</pre>');
            }
        });
        e.preventDefault();	//STOP default action
    });

    $("#houseFormForm").submit(); //SUBMIT FORM
});

// Players
$('#playerModal').on('show.bs.modal', function(e) {
    //get data-id attribute of the clicked element
    var playerId = $(e.relatedTarget).data('id');

    //populate the textbox
    $(e.currentTarget).find('#playerForm').load("index.php?page=ajax&action=editPlayer&uid=" + playerId);
});
$("#playerSend").click(function()
{
    $("#playerFormForm").submit(function(e)
    {
        $("#playerForm").html("<img src='theme/binary/img/loading.gif'/>");
        var postData = $(this).serializeArray();
        var formURL = $(this).attr("action");
        $.ajax(
        {
            url : formURL,
            type: "POST",
            data : postData,
            success:function(data, textStatus, jqXHR) 
            {
                $("#playerForm").html('<pre>Erfolgreich! Ge&auml;nderte Datens&auml;tze: '+data+'</pre>');
            },
            error: function(jqXHR, textStatus, errorThrown) 
            {
                $("#playerForm").html('<pre>AJAX Request Failed<br/> textStatus='+textStatus+', errorThrown='+errorThrown+'</pre>');
            }
        });
        e.preventDefault();	//STOP default action
    });

    $("#playerFormForm").submit(); //SUBMIT FORM
});

// Remove entry from seperated list
function removeValue(list, value, separator) {
    separator = separator || ",";
    var values = list.split(separator);
    for(var i = 0 ; i < values.length ; i++) {
        if(values[i] == value) {
            values.splice(i, 1);
            return values.join(separator);
        }
    }
    return list;
}
function removeMember(id) {
    console.log(id);
    var list = $("#membersList").val();
    list = removeValue(list, id, ",");
    $("#membersList").val(list);
}