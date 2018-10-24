<?php
/**
 * Created by PhpStorm.
 * User: alcides
 * Date: 10/22/2018
 * Time: 4:22 p.m.
 */

$message = "
Correo de contacto de rooflesscompany.com.
</br></br>
Información del cliente:
</br></br>
Nombre: {$reserve['name']}
</br>
Mail: {$reserve['email']}
</br>
";
if($reserve['phone'])
    $message .= "Teléfono: {$reserve['phone']}</br>";
if($reserve['note'])
    $message .= "Nota: {$reserve['note']}";
