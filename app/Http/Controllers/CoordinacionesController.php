<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//PHP mailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


//mail
use App\Mail\ContactanosMailable;
use Illuminate\Support\Facades\Mail;
use App\Models\Siniestro;





class CoordinacionesController extends Controller
{
    public function index(){
        return view('contactanos.index');
    }

    public function store(Request $request){

         
         $siniestro = Siniestro::paginate(1000);

         $this->siniestro = $siniestro;
         
        
        // $email = $this->siniestro['mailperito'];
        

        $correo = new ContactanosMailable($request->all());
        Mail::to('test-oomo0v99w@srv1.mail-tester.com')->send($correo);

        return redirect()->route('siniestros.index');

        
    }

    public function contacto(Request $request){

         
        $siniestro = Siniestro::paginate(1000);

        $this->siniestro = $siniestro;
        
       
    //    $email = $this->siniestro['mailPAS'];

       
       

       $correo = new ContactanosMailable($request->all());
       Mail::to('test-oomo0v99w@srv1.mail-tester.com')->send($correo);

       return redirect()->route('siniestros.index');

       
   }

    public function correo(Request $request){ // Request $request

        $siniestro = $request->siniestro;
        $cc = $request->cc;
        $cc2 = $request->cc2;
        $nrocorto = $request->nrocorto;
        $email = $request->emailPas;
        $patente = $request->patente;
        $usuario = $request->coordinador;
        $file = $request->file;

        $asunto = "Estudio DAG - Siniestro: $siniestro- Patente: $patente - $nrocorto";

        $cuerpodelmail = "<div class=>  
        <div class=>
            <div class=>
                <div class=>
                    <div class=>
                                
                                 
                                <div id=':mdi' class='Am Al editable LW-avf tS-tW' hidefocus='true' aria-label='Cuerpo del mensaje' g_editable='true' role='textbox' aria-multiline='true' contenteditable='true' tabindex='1' style='direction: ltr; min-height: 226px;' spellcheck='false'><div dir='ltr'><div><div dir='ltr'><div dir='ltr'><div><div dir='ltr'><div><div dir='ltr'><div dir='ltr'><div>Estimados,<br><br>me comunico desde Estudio DAG, al servicio de Mercantil Andina, a fin de coordinar una inspeccion del rodado patente <span zeum4c268='PR_3_0' data-ddnwab='PR_3_0' aria-invalid='spelling' class='LI ng'> $patente </span>.<br><br>Favor de aportar telefono del titular registral del rodado para coordinar la misma o informar los siguientes datos:<br><br>En caso de taller homologado , adjunto listado completo, quedando al aguardo de que nos indican taller y fecha por el cual&nbsp;
    
    pasara el asegurado<br><span zeum4c268='PR_10_0' data-ddnwab='PR_10_0' aria-invalid='grammar' class='Lm ng'>Tengan</span> en cuenta que no deben de coordinar turno con el taller; nos lo solicitan directamente por este medio:<br><br> <a href='https://siniestrosdag.com/urls/1654551972_TALLERES%20HOMOLOGADOS%20-%20ACTUALIZADO.xlsx'>https://siniestrosdag.com/urls/1654551972_TALLERES%20HOMOLOGADOS%20-%20ACTUALIZADO.xlsx</a>  <br>(En el caso de que el link no <span zeum4c268='PR_4_0' data-ddnwab='PR_4_0' aria-invalid='grammar' class='Lm ng'>funcione</span>, copiar y pegar en su navegador para descargar el archivo)<br><br>En caso de optar por un taller que no este en el listado, lo ideal es que saque turno, y nos lo informe por este medio con al menos 24 hs de antelacion, indicando fecha, domicilio, localidad, telefono y correo electronico del taller.<br><br>En caso de que el asegurado informe no tener piezas por reparar, pueden <span zeum4c268='PR_13_0' data-ddnwab='PR_13_0' aria-invalid='spelling' class='LI ng'>adjuntarnos</span> fotos por este medio.<br><br>Por cualquier consulta, quedo a entera disposicion.<br><br>Saludos cordiales.<br><br><br><br></div></div></div></div></div></div></div></div></div></div><div><div dir='ltr' class='gmail_signature' data-smartmail='gmail_signature'><div dir='ltr'><div><div><span style='color:rgb(34,34,34)'>$usuario</span><div style='color:rgb(34,34,34)'><font style='font-size:10pt'>
    Coordinacion de siniestros</font></div><div style='color:rgb(34,34,34)'><font style='font-size:10pt'>ESTUDIO DAG</font></div>
    <div style='color:rgb(34,34,34)'><a href='http://www.estudiodag.com.ar/' style='color:rgb(17,85,204)' target='_blank'>
    <font style='font-size:10pt'>www.estudiodag.com.ar</font></a></div></div></div></div></div></div></div>
    
                                </div>
                                
                                <div>

                                
                                
                          
                    </div>
                </div>
            </div>
        </div>
    </div>";

        @require '/home/u277224827/domains/siniestrosdag.com/dash_roles test/vendor/autoload.php';
        @require '/home/u277224827/domains/siniestrosdag.com/dash_roles test/vendor/phpmailer/phpmailer/src/Exception.php';
        @require '/home/u277224827/domains/siniestrosdag.com/dash_roles test/vendor/phpmailer/phpmailer/src/PHPMailer.php';
        @require '/home/u277224827/domains/siniestrosdag.com/dash_roles test/vendor/phpmailer/phpmailer/src/SMTP.php';
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;  
        $mail->Username = '';
        $mail->Password = '';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('', '');
        $mail->addAddress($email);
        $mail->AddCC($cc);
        $mail->AddCC($cc2);
        


        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body = $cuerpodelmail;
        $dt = $mail->Send();

                if($dt){

                    return redirect()->back()
                    ->with('success', 'Created successfully!');;
                } else{
                    echo 'Mensaje '. $mail->ErrorInfo;
                }
        

        }

        public function correoEdu(Request $request){ // Request $request

            $siniestro = $request->siniestro;
            // $email = $request->email;
            $patente = $request->patente;
            $fechaip = $request->fechaip;
            $nrocorto = $request->nrocorto;
            $comentariosparaip = $request->comentariosparaip;
            $telefono = $request->telefono;
            $localidad = $request->localidad;
            $direccion = $request->direccion;
            $modalidad = $request->modalidad;
            // $lugar = $request->lugar;
            $nombretaller = $request->nombretaller;
            $motivo = $request->motivo;
            $horario = $request->horario;
            $cliente = $request->cliente;
            $enviarorden = $request->enviarorden;
    
            $asunto = "Inspeccion - Siniestro: $siniestro- Patente: $patente $nrocorto";
    
            $cuerpodelmail = "<table width='1144' style='border-collapse:collapse;width:858pt'><colgroup><col width='52' style='width:39pt'><col width='176' style='width:132pt'><col width='179' 
            style='width:134pt'><col width='43' style='width:32pt'><col width='134' style='width:101pt'><col width='516' style='width:387pt'><col width='44' style='width:33pt'></colgroup><tbody><tr height='20' 
            style='height:15pt'><td width='52' height='20' style='width:39pt;height:15pt;color:black;font-family:Calibri,sans-serif;border-top:1pt solid black;border-right:none;border-bottom:none;border-left:1pt 
            solid black;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'></td><td width='176'
             style='width:132pt;color:black;font-family:Calibri,sans-serif;border-top:1pt solid black;border-right:none;border-bottom:none;border-left:none;background:rgb(255,230,153);padding-top:
                1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'></td><td width='179' style='width:134pt;color:rgb(255,230,153);font-family:
                Calibri,sans-serif;border-top:1pt solid windowtext;border-right:none;border-bottom:none;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:
                    1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'></td><td colspan='2' width='177' style='width:133pt;color:rgb(255,230,153);font-family:Calibri,sans-serif;border-top:1pt 
                    solid windowtext;border-right:none;border-bottom:none;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:
                    bottom;white-space:nowrap'></td><td width='516' style='width:387pt;color:rgb(255,230,153);font-family:Calibri,sans-serif;border-top:1pt solid windowtext;border-right:none;border-bottom:
                        none;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'></td><td width='44' 
                        style='width:33pt;color:rgb(255,230,153);font-family:Calibri,sans-serif;border-top:1pt solid windowtext;border-right:1pt solid windowtext;border-bottom:none;border-left:
                            none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'></td></tr><tr height='20'
                             style='height:15pt'><td height='20' style='height:15pt;color:black;font-family:Calibri,sans-serif;border-top:none;border-right:none;border-bottom:none;border-left:1pt
                              solid windowtext;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'></td><td
                               style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:
                                bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:
                                    1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:
                                        rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:
                                        black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:
                                            bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:
                                                1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border-top:none;border-right:1pt solid windowtext;border-bottom:none;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td></tr><tr height='21' style='height:15.75pt'><td height='21' style='height:15.75pt;color:black;font-family:Calibri,sans-serif;border-top:none;border-right:none;border-bottom:none;border-left:1pt solid windowtext;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'></td><td style='color:black;font-weight:700;font-family:Calibri,sans-serif;border:0.5pt solid windowtext;background:rgb(242,242,242);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>Fecha de inspección&nbsp;</td><td style='color:black;font-size:12pt;font-family:Calibri,sans-serif;border-top:0.5pt solid windowtext;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;border-left:none;padding-top:1px;padding-right:1px;padding-left:1px;vertical-align:bottom;white-space:nowrap'>$fechaip</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-weight:700;font-family:Calibri,sans-serif;border:0.5pt solid windowtext;background:rgb(242,242,242);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>Lugar de inspección</td><td style='color:black;font-size:12pt;font-family:Calibri,sans-serif;border-top:0.5pt solid windowtext;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;border-left:none;padding-top:1px;padding-right:1px;padding-left:1px;vertical-align:bottom;white-space:nowrap'></td><td style='color:black;font-family:Calibri,sans-serif;border-top:none;border-right:1pt solid windowtext;border-bottom:none;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td></tr><tr height='20' style='height:15pt'><td height='20' style='height:15pt;color:black;font-family:Calibri,sans-serif;border-top:none;border-right:none;border-bottom:none;border-left:1pt solid windowtext;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-weight:700;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-weight:700;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border-top:none;border-right:1pt solid windowtext;border-bottom:none;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td></tr><tr height='21' style='height:15.75pt'><td height='21' style='height:15.75pt;color:black;font-family:Calibri,sans-serif;border-top:none;border-right:none;border-bottom:none;border-left:1pt solid windowtext;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-weight:700;font-family:Calibri,sans-serif;border:0.5pt solid windowtext;background:rgb(242,242,242);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>Rango Horario</td><td style='color:black;font-size:12pt;font-family:Calibri,sans-serif;border-top:0.5pt solid windowtext;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;border-left:none;padding-top:1px;padding-right:1px;padding-left:1px;vertical-align:bottom;white-space:nowrap'>$horario</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-weight:700;font-family:Calibri,sans-serif;border:0.5pt solid windowtext;background:rgb(242,242,242);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>Nombre de taller</td><td style='color:black;font-size:12pt;font-family:Calibri,sans-serif;border-top:0.5pt solid windowtext;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;border-left:none;padding-top:1px;padding-right:1px;padding-left:1px;vertical-align:bottom;white-space:nowrap'>$nombretaller</td><td style='color:black;font-family:Calibri,sans-serif;border-top:none;border-right:1pt solid windowtext;border-bottom:none;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td></tr><tr height='20' style='height:15pt'><td height='20' style='height:15pt;color:black;font-family:Calibri,sans-serif;border-top:none;border-right:none;border-bottom:none;border-left:1pt solid windowtext;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-weight:700;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;
                                                white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border-top:none;border-right:1pt solid windowtext;border-bottom:none;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td></tr><tr height='21' style='height:15.75pt'><td height='21' style='height:15.75pt;color:black;font-family:Calibri,sans-serif;border-top:none;border-right:none;border-bottom:none;border-left:1pt solid windowtext;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-weight:700;font-family:Calibri,sans-serif;border:0.5pt solid windowtext;background:rgb(242,242,242);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>Tipo de inspección</td><td style='color:black;font-size:12pt;font-family:Calibri,sans-serif;border-top:0.5pt solid windowtext;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;border-left:none;padding-top:1px;padding-right:1px;padding-left:1px;vertical-align:bottom;white-space:nowrap'>$modalidad</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-weight:700;font-family:Calibri,sans-serif;border:0.5pt solid windowtext;background:rgb(242,242,242);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>Dirección</td><td style='color:black;font-size:12pt;font-family:Calibri,sans-serif;border-top:0.5pt solid windowtext;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;border-left:none;padding-top:1px;padding-right:1px;padding-left:1px;vertical-align:bottom;white-space:nowrap'>$direccion</td><td style='color:black;font-family:Calibri,sans-serif;border-top:none;border-right:1pt solid windowtext;border-bottom:none;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td></tr><tr height='20' style='height:15pt'><td height='20' style='height:15pt;color:black;font-family:Calibri,sans-serif;border-top:none;border-right:none;border-bottom:none;border-left:1pt solid windowtext;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-weight:700;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-weight:700;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border-top:none;border-right:1pt solid windowtext;border-bottom:none;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td></tr><tr height='21' style='height:15.75pt'><td height='21' style='height:15.75pt;color:black;font-family:Calibri,sans-serif;border-top:none;border-right:none;border-bottom:none;border-left:1pt solid windowtext;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-weight:700;font-family:Calibri,sans-serif;border:0.5pt solid windowtext;background:rgb(242,242,242);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>Motivo</td><td style='color:black;font-size:12pt;font-family:Calibri,sans-serif;border-top:0.5pt solid windowtext;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;border-left:none;padding-top:1px;padding-right:1px;padding-left:1px;vertical-align:bottom;white-space:nowrap'>$motivo</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-weight:700;font-family:Calibri,sans-serif;border:0.5pt solid windowtext;background:rgb(242,242,242);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>Localidad</td><td style='color:black;font-size:12pt;font-family:Calibri,sans-serif;border-top:0.5pt solid windowtext;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;border-left:none;padding-top:1px;padding-right:1px;padding-left:1px;vertical-align:bottom;white-space:nowrap'>$localidad</td><td style='color:black;font-family:Calibri,sans-serif;border-top:none;border-right:1pt solid windowtext;border-bottom:none;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td></tr><tr height='20' style='height:15pt'><td height='20' style='height:15pt;color:black;font-family:Calibri,sans-serif;border-top:none;border-right:none;border-bottom:none;border-left:1pt solid windowtext;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-weight:700;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-weight:700;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border-top:none;border-right:1pt solid windowtext;border-bottom:none;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td></tr><tr height='21' style='height:15.75pt'><td height='21' style='height:15.75pt;color:black;font-family:Calibri,sans-serif;border-top:none;border-right:none;border-bottom:none;border-left:1pt solid windowtext;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-weight:700;font-family:Calibri,sans-serif;border:0.5pt solid windowtext;background:rgb(242,242,242);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>Cliente</td><td style='color:black;font-size:12pt;font-family:Calibri,sans-serif;border-top:0.5pt solid windowtext;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;border-left:none;padding-top:1px;padding-right:1px;padding-left:1px;vertical-align:bottom;white-space:nowrap'>$cliente</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-weight:700;font-family:Calibri,sans-serif;border:0.5pt solid windowtext;background:rgb(242,242,242);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>TE</td><td 
                                                style='color:black;font-size:12pt;font-family:Calibri,sans-serif;border-top:0.5pt solid windowtext;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;border-left:none;padding-top:1px;padding-right:1px;padding-left:1px;vertical-align:bottom;white-space:nowrap'>$telefono</td><td style='color:black;font-family:Calibri,sans-serif;border-top:none;border-right:1pt solid windowtext;border-bottom:none;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td></tr><tr height='20' style='height:15pt'><td height='20' style='height:15pt;color:black;font-family:Calibri,sans-serif;border-top:none;border-right:none;border-bottom:none;border-left:1pt solid windowtext;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-weight:700;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border-top:none;border-right:1pt solid windowtext;border-bottom:none;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td></tr><tr height='25' style='height:18.75pt'><td height='25' style='height:18.75pt;color:black;font-family:Calibri,sans-serif;border-top:none;border-right:none;border-bottom:none;border-left:1pt solid windowtext;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-size:12pt;font-weight:700;font-family:Calibri,sans-serif;border:0.5pt solid windowtext;background:rgb(242,242,242);padding-top:1px;padding-right:1px;padding-left:1px;vertical-align:bottom;white-space:nowrap'>AUTORIZAR SINIESTRO</td><td style='color:black;font-size:14pt;font-weight:700;font-family:Calibri,sans-serif;border-top:0.5pt solid windowtext;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;border-left:none;background:rgb(146,208,80);padding-top:1px;padding-right:1px;padding-left:1px;vertical-align:bottom;white-space:nowrap'>$enviarorden</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-weight:700;font-family:Calibri,sans-serif;border:0.5pt solid windowtext;background:rgb(242,242,242);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>Email</td><td style='color:black;font-size:12pt;font-family:Calibri,sans-serif;border-top:0.5pt solid windowtext;border-right:0.5pt solid windowtext;border-bottom:0.5pt solid windowtext;border-left:none;padding-top:1px;padding-right:1px;padding-left:1px;vertical-align:bottom;white-space:nowrap'> </td><td style='color:black;font-family:Calibri,sans-serif;border-top:none;border-right:1pt solid windowtext;border-bottom:none;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td></tr><tr height='20' style='height:15pt'><td height='20' style='height:15pt;color:black;font-family:Calibri,sans-serif;border-top:none;border-right:none;border-bottom:none;border-left:1pt solid windowtext;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border-top:none;border-right:1pt solid windowtext;border-bottom:none;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td></tr><tr height='19' style='height:14.25pt'><td height='19' style='height:14.25pt;color:black;font-family:Calibri,sans-serif;border-top:none;border-right:none;border-bottom:none;border-left:1pt solid windowtext;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-weight:700;font-family:Calibri,sans-serif;border-top:0.5pt solid windowtext;border-right:none;border-bottom:0.5pt solid windowtext;border-left:0.5pt solid windowtext;background:rgb(242,242,242);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>$comentariosparaip</td><td colspan='4' rowspan='3' width='872' height='59' style='width:654pt;height:44.25pt;color:black;font-size:12pt;font-weight:700;font-family:Calibri,sans-serif;border-top:0.5pt solid windowtext;border-right:none;border-bottom:none;border-left:0.5pt solid windowtext;padding-top:1px;padding-right:1px;padding-left:1px;vertical-align:bottom'>&nbsp;observaciones para el perito</td><td style='color:black;font-family:Calibri,sans-serif;border-top:none;border-right:1pt solid windowtext;border-bottom:none;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td></tr><tr height='20' style='height:15pt'><td height='20' style='height:15pt;color:black;font-family:Calibri,sans-serif;border-top:none;border-right:none;border-bottom:none;border-left:1pt solid windowtext;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border-top:none;border-right:1pt solid windowtext;border-bottom:none;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td></tr><tr height='20' style='height:15pt'><td height='20' style='height:15pt;color:black;font-family:Calibri,sans-serif;border-top:none;border-right:none;border-bottom:none;border-left:1pt solid windowtext;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border-top:none;border-right:1pt solid windowtext;border-bottom:none;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td></tr><tr height='20' style='height:15pt'><td height='20' style='height:15pt;color:black;font-family:Calibri,sans-serif;border-top:none;border-right:none;border-bottom:1pt solid windowtext;border-left:1pt solid windowtext;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border-top:none;border-right:none;border-bottom:1pt solid windowtext;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border-top:none;border-right:none;border-bottom:1pt solid windowtext;border-left:none;background:rgb(255,230,153);padding-top:1px;
                                                padding-right:
                                                    1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border-top:none;border-right:none;border-bottom:1pt solid windowtext;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border-top:none;border-right:none;border-bottom:1pt solid windowtext;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border-top:none;border-right:none;border-bottom:1pt solid windowtext;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td><td style='color:black;font-family:Calibri,sans-serif;border-top:none;border-right:1pt solid windowtext;border-bottom:1pt solid windowtext;border-left:none;background:rgb(255,230,153);padding-top:1px;padding-right:1px;padding-left:1px;font-size:11pt;vertical-align:bottom;white-space:nowrap'>&nbsp;</td></tr></tbody></table>";
    
            @require '/home/u277224827/domains/siniestrosdag.com/dash_roles test/vendor/autoload.php';
            @require '/home/u277224827/domains/siniestrosdag.com/dash_roles test/vendor/phpmailer/phpmailer/src/Exception.php';
            @require '/home/u277224827/domains/siniestrosdag.com/dash_roles test/vendor/phpmailer/phpmailer/src/PHPMailer.php';
            @require '/home/u277224827/domains/siniestrosdag.com/dash_roles test/vendor/phpmailer/phpmailer/src/SMTP.php';
            $mail = new PHPMailer(true);
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;  
            $mail->Username = '';
            $mail->Password = '';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
    
            $mail->setFrom('derivaciones@siniestrosdag.com', 'Coordinaciones - Estudio DAG');
            $mail->addAddress('arcichsilvio@gmail.com');
            
    
    
            $mail->isHTML(true);
            $mail->Subject = $asunto;
            $mail->Body = $cuerpodelmail;
            $dt = $mail->Send();
    
                    if($dt){
    
                    echo 'Correo enviado';
                    } else{
                        echo 'Mensaje '. $mail->ErrorInfo;
                    }
            
    
            }
}


