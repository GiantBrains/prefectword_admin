<?php

use yii\helpers\Html;
use dosamigos\ckeditor\CKEditor;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */

$calculate = <<<JS
  $(document).ready(function(){
         moment().format('MMMM Do YYYY, h:mm:ss a');
            var service = 12;
            var type = 1;
            var urgency = 1;
            var pages = 1;
            var level = 1;
            var spacing = 1;
             $('#spacing-id').change('focusin', function(){
            order_spacing = parseInt($(this).val());
            
            if(order_spacing===1){
                spacing = 1;
            }else if(order_spacing===2){
               spacing =2;
            }
            $('#min-amount').val('$'+(service*type*urgency*pages*level*spacing).toFixed(2));
        });
        $('#service-id').change('focusin', function(){
            order_service = parseInt($(this).val());
            
            if(order_service===1){
                service = 12;
            }else if(order_service===2){
                service=10;
            }else if(order_service===3){
                service= 7.5;
            }
            $('#min-amount').val('$'+(service*type*urgency*pages*level*spacing).toFixed(2));
        });
        $("#type-id").change('focusin', function(){
               typeoforder = parseInt($(this).val());
                 if(typeoforder===1){
                type = 1.1;
                }else if (typeoforder===2){
                 type = 1.2;      
                }else if (typeoforder===3){
                 type = 1.1;      
                }else if (typeoforder===4){
                 type = 1.1;      
                }else if (typeoforder===5){
                 type = 1.1;      
                 }else if (typeoforder===6){
                 type = 1.1;      
                 }else if (typeoforder===7){
                 type = 1.2;      
                 }else if (typeoforder===8){
                 type = 1.1;      
                 }else if (typeoforder===9){
                 type = 1.1;      
                 }else if (typeoforder===10){
                 type = 1.2;      
                 }else if (typeoforder===11){
                 type = 1.2;      
                 }else if (typeoforder===12){
                 type = 1.2;      
                 }else if (typeoforder===13){
                 type = 1.2;      
                 }else if (typeoforder===14){
                 type = 1.2;      
                 }else if (typeoforder===15){
                 type = 1.2;      
                 }else if (typeoforder===16){
                 type = 1.2;      
                 }else if (typeoforder===17){
                 type = 1.2;      
                 }else if (typeoforder===18){
                 type = 1.2;      
                 }else if (typeoforder===20){
                 type = 1;      
                 }else if (typeoforder===22){
                 type = 2.0;      
                 }else if (typeoforder===23){
                 type = 2.2;      
                 }else if (typeoforder===24){
                 type = 1.5;      
                 }else if (typeoforder===25){
                 type = 1.1;      
                 }else if (typeoforder===26){
                 type = 1.2;      
                 }else if (typeoforder===27){
                 type = 0.7;      
                 }else if (typeoforder===28){
                 type = 0.8;      
                 }else if (typeoforder===31){
                 type = 1;      
                 }else if (typeoforder===32){
                 type = 1.1;      
                 }else if (typeoforder===33){
                 type = 1.2;      
                 }else if (typeoforder===34){
                 type = 1;      
                 }else if (typeoforder===35){
                 type = 2.2;      
                 }else if (typeoforder===36){
                 type = 1.2;      
                 }else if (typeoforder===37){
                 type = 1.2;      
                 }else if (typeoforder===38){
                 type = 1.2;      
                 }else if (typeoforder===39){
                 type = 1.5;      
                 }                
                $('#min-amount').val('$'+(service*type*urgency*pages*level*spacing).toFixed(2));
        });
        $("#urgency-id").change('focusin', function(){
                order_urgency = parseInt($(this).val());
                
                if(order_urgency===1){
                urgency = 2.5;
                }else if (order_urgency===2){
                 urgency = 2.0;      
                }else if (order_urgency===3){
                 urgency = 1.8;      
                }else if (order_urgency===4){
                 urgency = 1.5;      
                }else if (order_urgency===5){
                 urgency = 1.4;      
                }else if (order_urgency===6){
                 urgency = 1.3;      
                }else if (order_urgency===7){
                 urgency = 1.2;      
                }else if (order_urgency===8){
                 urgency = 1.1;      
                }else if (order_urgency===9){
                 urgency = 1.1;      
                }else if (order_urgency===10){
                 urgency = 1.0;      
                }else if (order_urgency===11){
                 urgency = 1.0;      
                }else if (order_urgency===12){
                 urgency = 1.0;      
                }else if (order_urgency===13){
                 urgency = 1.0;      
                }else if (order_urgency===14){
                 urgency = 1.0;      
               }else if (order_urgency===15){
                 urgency = 1.0;      
                }
                $('#min-amount').val('$'+(service*type*urgency*pages*level*spacing).toFixed(2));
        });
         $('#order-pages_id').change('focusin', function(){
                order_pages = parseInt($(this).val());
                if(order_pages===1){
                    pages = 1;
                }else if(order_pages===2){
                    pages=2*0.95;
                }else if(order_pages===3){
                    pages= 3*0.95;
                 }else if(order_pages===4){
                    pages=4*0.95;
                }else if(order_pages===5){
                    pages= 5*0.95;
                 }else if(order_pages===6){
                    pages=6*0.925;
                }else if(order_pages===7){
                    pages= 7*0.925;
                }else if(order_pages===8){
                    pages=8*0.925;
                }else if(order_pages===9){
                    pages= 9*0.925;
                 }else if(order_pages===10){
                    pages=10*0.9;
                }else if(order_pages===11){
                    pages= 11*0.9;
                 }else if(order_pages===12){
                    pages=12*0.9;
                }else if(order_pages===13){
                    pages= 13*0.9;
                }else if(order_pages===14){
                    pages=14*0.9;
                }else if(order_pages===15){
                    pages= 15*0.9;
                }else if(order_pages===16){
                    pages=16*0.9;
                }else if(order_pages===17){
                    pages= 17*0.9;
                }else if(order_pages===18){
                    pages=18*0.9;
                }else if(order_pages===19){
                    pages= 19*0.9;
                }else if(order_pages===20){
                    pages=20*0.9;
                }else if(order_pages===21){
                    pages= 21*0.85;
                 }else if(order_pages===22){
                    pages=22*0.85;
                }else if(order_pages===23){
                    pages= 23*0.85;
                 }else if(order_pages===24){
                    pages=24*0.85;
                }else if(order_pages===25){
                    pages= 25*0.85;
                }else if(order_pages===26){
                    pages=26*0.85;
                }else if(order_pages===27){
                    pages= 27*0.85;
                }else if(order_pages===28){
                    pages=28*0.85;
                }else if(order_pages===29){
                    pages= 29*0.85;
                }else if(order_pages===30){
                    pages=30*0.85;
                }else if(order_pages===31){
                    pages= 31*0.85;
                }else if(order_pages===32){
                    pages=32*0.85;
                }else if(order_pages===33){
                    pages= 33*0.85;
                 }else if(order_pages===34){
                    pages=34*0.85;
                }else if(order_pages===35){
                    pages= 35*0.85;
                 }else if(order_pages===36){
                    pages=36*0.85;
                }else if(order_pages===37){
                    pages= 37*0.85;
                }else if(order_pages===38){
                    pages=38*0.85;
                }else if(order_pages===39){
                    pages= 39*0.85;
                 }else if(order_pages===40){
                    pages=40*0.85;
                }else if(order_pages===41){
                    pages= 41*0.85;
                 }else if(order_pages===42){
                    pages=42*0.85;
                }else if(order_pages===43){
                    pages= 43*0.85;
                }else if(order_pages===44){
                    pages=44*0.85;
                }else if(order_pages===45){
                    pages= 45*0.85;
                 }else if(order_pages===46){
                    pages=46*0.85;
                }else if(order_pages===47){
                    pages=47*0.85;
                 }else if(order_pages===48){
                    pages=48*0.85;
                }else if(order_pages===49){
                    pages= 49*0.85;
                }else if(order_pages===50){
                    pages=50*0.85;
                }else if(order_pages===51){
                    pages= 51*0.85;
                 }else if(order_pages===52){
                    pages=52*0.85;
                }else if(order_pages===53){
                    pages= 53*0.85;
                 }else if(order_pages===54){
                    pages=54*0.85;
                }else if(order_pages===55){
                    pages= 55*0.85;
                }else if(order_pages===56){
                    pages=56*0.85;
                }else if(order_pages===57){
                    pages= 57*0.85;
                 }else if(order_pages===58){
                    pages=58*0.85;
                }else if(order_pages===59){
                    pages= 59*0.85;
                 }else if(order_pages===60){
                    pages=60*0.85;
                }else if(order_pages===61){
                    pages= 61*0.85;
                }else if(order_pages===62){
                    pages=62*0.85;
                }else if(order_pages===63){
                    pages= 63*0.85;
                 }else if(order_pages===64){
                    pages=64*0.85;
                }else if(order_pages===65){
                    pages= 65*0.85;
                 }else if(order_pages===66){
                    pages=66*0.85;
                }else if(order_pages===67){
                    pages= 67*0.85;
                }else if(order_pages===68){
                    pages=68*0.85;
                }else if(order_pages===69){
                    pages= 69*0.85;
                 }else if(order_pages===70){
                    pages=70*0.85;
                }else if(order_pages===71){
                    pages= 71*0.85;
                 }else if(order_pages===72){
                    pages=72*0.85;
                }else if(order_pages===73){
                    pages= 73*0.85;
                }else if(order_pages===74){
                    pages=74*0.85;
                }else if(order_pages===75){
                    pages= 75*0.85;
                 }else if(order_pages===76){
                    pages=76*0.85;
                }else if(order_pages===77){
                    pages= 77*0.85;
                 }else if(order_pages===78){
                    pages=78*0.85;
                }else if(order_pages===79){
                    pages= 79*0.85;
                }else if(order_pages===80){
                    pages=80*0.85;
                }else if(order_pages===81){
                    pages= 81*0.85;
                 }else if(order_pages===82){
                    pages=82*0.85;
                }else if(order_pages===83){
                    pages= 83*0.85;
                 }else if(order_pages===84){
                    pages=84*0.85;
                }else if(order_pages===85){
                    pages= 85*0.85;
                }else if(order_pages===86){
                    pages=86*0.85;
                }else if(order_pages===87){
                    pages= 87*0.85;
                 }else if(order_pages===88){
                    pages=88*0.85;
                }else if(order_pages===89){
                    pages= 89;
                 }else if(order_pages===90){
                    pages=90*0.85;
                }else if(order_pages===91){
                    pages= 91*0.85;
                }else if(order_pages===92){
                    pages=92*0.85;
                }else if(order_pages===93){
                    pages= 93*0.85;
                 }else if(order_pages===94){
                    pages=94*0.85;
                }else if(order_pages===95){
                    pages= 95*0.85;
                 }else if(order_pages===96){
                    pages=96*0.85;
                }else if(order_pages===97){
                    pages= 97*0.85;
                }else if(order_pages===98){
                    pages=98*0.85;
                }else if(order_pages===99){
                    pages= 99*0.85;
                 }else if(order_pages===100){
                    pages=100*0.85;
                }else if(order_pages===101){
                    pages= 101*0.85;
                 }else if(order_pages===102){
                    pages=102*0.85;
                }else if(order_pages===103){
                    pages= 103*0.85;
                }else if(order_pages===104){
                    pages=104*0.85;
                }else if(order_pages===105){
                    pages= 105*0.85;
                 }else if(order_pages===106){
                    pages=106*0.85;
                }else if(order_pages===107){
                    pages= 107*0.85;
                 }else if(order_pages===108){
                    pages=108*0.85;
                }else if(order_pages===109){
                    pages= 109*0.85;
                }else if(order_pages===110){
                    pages=110*0.85;
               }else if(order_pages===111){
                    pages= 111*0.85;
                 }else if(order_pages===112){
                    pages=112*0.85;
                }else if(order_pages===113){
                    pages= 113*0.85;
                }else if(order_pages===114){
                    pages=114*0.85;
                }else if(order_pages===115){
                    pages= 115*0.85;
                 }else if(order_pages===116){
                    pages=116*0.85;
                }else if(order_pages===117){
                    pages= 117*0.85;
                 }else if(order_pages===118){
                    pages=118*0.85;
                }else if(order_pages===119){
                    pages= 119*0.85;
                }else if(order_pages===120){
                    pages=120*0.85;
               }else if(order_pages===121){
                    pages= 121*0.85;
                 }else if(order_pages===122){
                    pages=122*0.85;
                }else if(order_pages===123){
                    pages= 123*0.85;
                }else if(order_pages===124){
                    pages=124*0.85;
                }else if(order_pages===125){
                    pages= 125*0.85;
                 }else if(order_pages===126){
                    pages=126*0.85;
                }else if(order_pages===127){
                    pages= 127*0.85;
                 }else if(order_pages===128){
                    pages=128*0.85;
                }else if(order_pages===129){
                    pages= 129*0.85;
                }else if(order_pages===130){
                    pages=130*0.85;
                }else if(order_pages===131){
                    pages= 131*0.85;
                 }else if(order_pages===132){
                    pages=132*0.85;
                }else if(order_pages===133){
                    pages= 133*0.85;
                }else if(order_pages===134){
                    pages=134*0.85;
                }else if(order_pages===135){
                    pages= 135*0.85;
                 }else if(order_pages===136){
                    pages=136*0.85;
                }else if(order_pages===137){
                    pages= 137*0.85;
                 }else if(order_pages===138){
                    pages=138*0.85;
                }else if(order_pages===139){
                    pages= 139*0.85;
                }else if(order_pages===140){
                    pages=140*0.85;
                 }else if(order_pages===141){
                    pages= 141*0.85;
                 }else if(order_pages===142){
                    pages=142*0.85;
                }else if(order_pages===143){
                    pages= 143*0.85;
                }else if(order_pages===144){
                    pages=144*0.85;
                }else if(order_pages===145){
                    pages= 145*0.85;
                 }else if(order_pages===146){
                    pages=146*0.85;
                }else if(order_pages===147){
                    pages= 147*0.85;
                 }else if(order_pages===148){
                    pages=148*0.85;
                }else if(order_pages===149){
                    pages= 149*0.85;
                }else if(order_pages===150){
                    pages=150*0.85;
                 }else if(order_pages===151){
                    pages= 151*0.85;
                 }else if(order_pages===152){
                    pages=152*0.85;
                }else if(order_pages===153){
                    pages= 153*0.85;
                }else if(order_pages===154){
                    pages=154*0.85;
                }else if(order_pages===155){
                    pages= 155*0.85;
                 }else if(order_pages===156){
                    pages=156*0.85;
                }else if(order_pages===157){
                    pages= 157*0.85;
                 }else if(order_pages===158){
                    pages=158*0.85;
                }else if(order_pages===159){
                    pages= 159*0.85;
                }else if(order_pages===160){
                    pages=160*0.85;
                 }else if(order_pages===161){
                    pages= 161*0.85;
                 }else if(order_pages===162){
                    pages=162*0.85;
                }else if(order_pages===163){
                    pages= 163*0.85;
                }else if(order_pages===164){
                    pages=164*0.85;
                }else if(order_pages===165){
                    pages= 165*0.85;
                 }else if(order_pages===166){
                    pages=166*0.85;
                }else if(order_pages===167){
                    pages= 167*0.85;
                 }else if(order_pages===168){
                    pages=168*0.85;
                }else if(order_pages===169){
                    pages= 169*0.85;
                }else if(order_pages===170){
                    pages=170*0.85;
                }else if(order_pages===171){
                    pages= 171*0.85;
                 }else if(order_pages===172){
                    pages=172*0.85;
                }else if(order_pages===173){
                    pages= 173*0.85;
                }else if(order_pages===174){
                    pages=174*0.85;
                }else if(order_pages===175){
                    pages= 175*0.85;
                 }else if(order_pages===176){
                    pages=176*0.85;
                }else if(order_pages===177){
                    pages= 177*0.85;
                 }else if(order_pages===178){
                    pages=178*0.85;
                }else if(order_pages===179){
                    pages= 179*0.85;
                }else if(order_pages===180){
                    pages=180*0.85;
                 }else if(order_pages===181){
                    pages= 181*0.85;
                 }else if(order_pages===182){
                    pages=182*0.85;
                }else if(order_pages===183){
                    pages= 183*0.85;
                }else if(order_pages===184){
                    pages=184*0.85;
                }else if(order_pages===185){
                    pages= 185*0.85;
                 }else if(order_pages===186){
                    pages=186*0.85;
                }else if(order_pages===187){
                    pages= 187*0.85;
                 }else if(order_pages===188){
                    pages=188*0.85;
                }else if(order_pages===189){
                    pages= 189*0.85;
                }else if(order_pages===190){
                    pages=190*0.85;
                 }else if(order_pages===191){
                    pages= 191*0.85;
                 }else if(order_pages===192){
                    pages=192*0.85;
                }else if(order_pages===193){
                    pages= 193*0.85;
                }else if(order_pages===194){
                    pages=194*0.85;
                }else if(order_pages===195){
                    pages= 195*0.85;
                 }else if(order_pages===196){
                    pages=196*0.85;
                }else if(order_pages===197){
                    pages= 197*0.85;
                 }else if(order_pages===198){
                    pages=198*0.85;
                }else if(order_pages===199){
                    pages= 199*0.85;
                }else if(order_pages===200){
                    pages=200*0.85;
                }
                
                 //single spaced
            else if(order_pages===201){
                pages= 1;
            }else if(order_pages===202){
                pages=2*0.95;
            }else if(order_pages===203){
                pages= 3*0.95;
            }else if(order_pages===204){
                pages= 4*0.95;
            }else if(order_pages===205){
                pages= 5*0.95;
            }else if(order_pages===206){
                pages=6*0.925;
            }else if(order_pages===207){
                pages= 7*0.925;
            }else if(order_pages===208){
                pages=8*0.925;
            }else if(order_pages===209){
                pages= 9*0.925;
            }else if(order_pages===210){
                pages=10*0.90;
            }else if(order_pages===211){
                pages= 11*0.90;
            }else if(order_pages===212){
                pages=12*0.90;
            }else if(order_pages===213){
                pages= 13*0.90;
            }else if(order_pages===214){
                pages=14*0.90;
            }else if(order_pages===215){
                pages= 15*0.90;
            }else if(order_pages===216){
                pages=16*0.90;
            }else if(order_pages===217){
                pages= 17*0.90;
            }else if(order_pages===218){
                pages=18*0.90;
            }else if(order_pages===219){
                pages= 19*0.90;
            }else if(order_pages===220){
                pages=20*0.90;
            }else if(order_pages===221){
                pages= 21*0.85;
            }else if(order_pages===222){
                pages=22*0.85;
            }else if(order_pages===223){
                pages= 23*0.85;
            }else if(order_pages===224){
                pages=24*0.85;
            }else if(order_pages===225){
                pages= 25*0.85;
            }else if(order_pages===226){
                pages=26*0.85;
            }else if(order_pages===227){
                pages= 27*0.85;
            }else if(order_pages===228){
                pages=28*0.85;
            }else if(order_pages===229){
                pages= 29*0.85;
            }else if(order_pages===230){
                pages=30*0.85;
            }else if(order_pages===231){
                pages= 31*0.85;
            }else if(order_pages===232){
                pages=32*0.85;
            }else if(order_pages===233){
                pages= 33*0.85;
            }else if(order_pages===234){
                pages=34*0.85;
            }else if(order_pages===235){
                pages= 35*0.85;
            }else if(order_pages===236){
                pages=36*0.85;
            }else if(order_pages===237){
                pages= 37*0.85;
            }else if(order_pages===238){
                pages=38*0.85;
            }else if(order_pages===239){
                pages= 39*0.85;
            }else if(order_pages===240){
                pages=40*0.85;
            }else if(order_pages===241){
                pages= 41*0.85;
            }else if(order_pages===242){
                pages=42*0.85;
            }else if(order_pages===243){
                pages= 43*0.85;
            }else if(order_pages===244){
                pages=44*0.85;
            }else if(order_pages===245){
                pages= 45*0.85;
            }else if(order_pages===246){
                pages=46*0.85;
            }else if(order_pages===247){
                pages= 47*0.85;
            }else if(order_pages===248){
                pages=48*0.85;
            }else if(order_pages===249){
                pages= 49*0.85;
            }else if(order_pages===250){
                pages=50*0.85;
            }else if(order_pages===251){
                pages= 51*0.85;
            }else if(order_pages===252){
                pages=52*0.85;
            }else if(order_pages===253){
                pages= 53*0.85;
            }else if(order_pages===254){
                pages=54*0.85;
            }else if(order_pages===255){
                pages= 55*0.85;
            }else if(order_pages===256){
                pages=56*0.85;
            }else if(order_pages===257){
                pages= 57*0.85;
            }else if(order_pages===258){
                pages=58*0.85;
            }else if(order_pages===259){
                pages= 59*0.85;
            }else if(order_pages===260){
                pages=60*0.85;
            }else if(order_pages===261){
                pages= 61*0.85;
            }else if(order_pages===262){
                pages=62*0.85;
            }else if(order_pages===263){
                pages= 63*0.85;
            }else if(order_pages===264){
                pages=64*0.85;
            }else if(order_pages===265){
                pages= 65*0.85;
            }else if(order_pages===266){
                pages=66*0.85;
            }else if(order_pages===267){
                pages= 67*0.85;
            }else if(order_pages===268){
                pages=68*0.85;
            }else if(order_pages===269){
                pages= 69*0.85;
            }else if(order_pages===270){
                pages=70*0.85;
            }else if(order_pages===271){
                pages= 71*0.85;
            }else if(order_pages===272){
                pages=72*0.85;
            }else if(order_pages===273){
                pages= 73*0.85;
            }else if(order_pages===274){
                pages=74*0.85;
            }else if(order_pages===275){
                pages= 75*0.85;
            }else if(order_pages===276){
                pages=76*0.85;
            }else if(order_pages===277){
                pages= 77*0.85;
            }else if(order_pages===278){
                pages=78*0.85;
            }else if(order_pages===279){
                pages= 79*0.85;
            }else if(order_pages===280){
                pages=80*0.85;
            }else if(order_pages===281){
                pages= 81*0.85;
            }else if(order_pages===282){
                pages=82*0.85;
            }else if(order_pages===283){
                pages= 83*0.85;
            }else if(order_pages===284){
                pages=84*0.85;
            }else if(order_pages===285){
                pages= 85*0.85;
            }else if(order_pages===286){
                pages=86*0.85;
            }else if(order_pages===287){
                pages= 87*0.85;
            }else if(order_pages===288){
                pages=88*0.85;
            }else if(order_pages===289){
                pages= 89*0.85;
            }else if(order_pages===290){
                pages=90*0.85;
            }else if(order_pages===291){
                pages= 91*0.85;
            }else if(order_pages===292){
                pages=92*0.85;
            }else if(order_pages===293){
                pages= 93*0.85;
            }else if(order_pages===294){
                pages=94*0.85;
            }else if(order_pages===295){
                pages= 95*0.85;
            }else if(order_pages===296){
                pages=96*0.85;
            }else if(order_pages===297){
                pages= 97*0.85;
            }else if(order_pages===298){
                pages=98*0.85;
            }else if(order_pages===299){
                pages= 99*0.85;
            }else if(order_pages===300){
                pages=100*0.85;
            }
                $('#min-amount').val('$'+(service*type*urgency*pages*level*spacing).toFixed(2));
        });
          $('#level-id').change('focusin', function(){
                order_level = parseInt($(this).val());
                
                if(order_level===1){
                    level = 0.8;
                }else if(order_level===2){
                    level=1;
                }else if(order_level===4){
                    level= 1.1;
                 }else if(order_level===5){
                    level= 1.2;
                }
                $('#min-amount').val('$'+(service*type*urgency*pages*level*spacing).toFixed(2));
        });
    });
JS;
$this->registerJs($calculate);
?>
<div style="text-align: center">
    <h4 style="font-size: 25px" class="essay-font">Price: <input class="tcost" style="border: none; width: 100px; font-size: 25px" type="text" id="min-amount" value="$0.00" readonly="readonly"></h4>
</div>
<div class="row" style="padding-right: 15px; padding-top: 15px; border-radius: 10px; padding-left: 15px; background-color: #deedf9;">
    <div class="order-form">
        <?php $form = ActiveForm::begin();
        $session = Yii::$app->session;
        ?>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'service_id')->label('Service')->dropDownList(\app\models\Service::getServices(),
                    ['prompt'=> '...select Service....', 'id'=>'service-id']) ?>

                <?= $form->field($model, 'type_id')->label('Type of Paper')->dropDownList(\app\models\Type::getTypes(),
                    ['prompt'=> '...select Type....', 'id'=>'type-id']) ?>

                <?= $form->field($model, 'urgency_id')->label('Urgency')->dropDownList(\app\models\Urgency::getUrgency(), [
                    'prompt'=> '...select urgency....', 'id'=>'urgency-id']) ?>

                <?= $form->field($model, 'spacing_id')->label('Spacing')->dropDownList(\app\models\Spacing::getSpacings(), [
                    'prompt'=> '...select Spacing....', 'id'=>'spacing-id']) ?>

                <?= $form->field($model, 'pages_id')->widget(\kartik\depdrop\DepDrop::classname(), [
                    'data' =>\app\models\Pages::getThepages($model->spacing_id),
                    'options'=>['prompt'=>'---Select pages----'],
                    'pluginOptions'=>[
                        'depends'=>['spacing-id'],
                        'placeholder'=>'--select pages...',
                        'url'=>\yii\helpers\Url::to(['/order/subcat'])
                    ]
                ]) ?>

                <?= $form->field($model, 'level_id')->label('Level')->dropDownList(\app\models\Level::getLevels(), [
                    'prompt'=> '...select Level....', 'id'=>'level-id']) ?>

                <?= $form->field($model, 'subject_id')->label('Subject')->dropDownList(\app\models\Subject::getSubjects(), [
                    'options' => [19 => ['Selected'=>'selected'], 'prompt'=> '...select subject....', 'id'=>'subject-id']]) ?>

                <?= $form->field($model, 'style_id')->label('Styles')->dropDownList(\app\models\Style::getStyles(), [
                    'options' => [1 => ['Selected'=>'selected'], 'prompt'=> '...select Style....', 'id'=>'style-id']]) ?>

                <?= $form->field($model, 'sources_id')->label('Sources')->dropDownList(\app\models\Sources::getSources(), [
                    'options' => [3 => ['Selected'=>'selected'], 'prompt'=> '...select Sources....', 'id'=>'sources-id']]) ?>
                <!---->
                <!--    --><?php //echo $form->field($model, 'pagesummary')->textInput() ?>
                <!---->
                <!--    --><?php //echo $form->field($model, 'plagreport')->textInput() ?>
                <!---->
                <!--    --><?php //eho $form->field($model, 'initialdraft')->textInput() ?>
                <?= $form->field($model, 'language_id')->label('Language')->dropDownList(\app\models\Language::getLanguages(), [
                    'options' => [1 => ['Selected'=>'selected'], 'prompt'=> '...select Language....', 'id'=>'language-id']]) ?>
            </div>
            <div class="col-md-8">
                <?= $form->field($model, 'topic')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'instructions')->widget(CKEditor::className(), [
                    'preset' => 'custom',
                    'options'=>['rows'=>18],
                    'clientOptions' => [
                        'height'=>  400,
                        'toolbar' => [
                            [
                                'name' => 'row1',
                                'items' => [
                                    'Source', '-',
                                    'Bold', 'Italic', 'Underline', 'Strike', '-',
                                    'Subscript', 'Superscript', 'RemoveFormat', '-',
                                    'TextColor', 'BGColor', '-',
                                    'NumberedList', 'BulletedList', '-',
                                    'Outdent', 'Indent', '-', 'Blockquote', '-',
                                    'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', 'list', 'indent', 'blocks', 'align', 'bidi', '-',
                                    'Link', 'Unlink', 'Anchor', '-',
                                    'ShowBlocks', 'Maximize',
                                ],
                            ],
                            [
                                'name' => 'row2',
                                'items' => [
                                    'Image', 'Table', 'HorizontalRule', 'SpecialChar', 'Iframe', '-',
                                    'NewPage', 'Print', 'Templates', '-',
                                    'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-',
                                    'Undo', 'Redo', '-',
                                    'Find', 'SelectAll', 'Format', 'Font', 'FontSize','styles','colors', 'tools', 'others'
                                ],
                            ],
                        ],
                    ],
                ]) ?>

                <!--            --><?php //echo $form->field($model, 'instructions')->widget(CKEditor::className(), [
                //                'options' => ['rows' => 22],
                //                'preset' => 'basic',
                //                'clientOptions' => ['height' => 420]
                //            ]) ?>

                <!--    --><?php //echo $form->field($model, 'qualitycheck')->textInput() ?>
                <!---->
                <!--    --><?php //echo $form->field($model, 'topwriter')->textInput() ?>

                <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

                <?php //echo $form->field($model, 'promocode')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
