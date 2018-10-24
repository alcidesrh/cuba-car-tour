<?php
/**
 * Created by PhpStorm.
 * User: alcides
 * Date: 10/22/2018
 * Time: 4:22 p.m.
 */

$message = "
</br>
Reserva transporte:
</br></br>
Transporte: {$tour_title}
</br></br>
Carro: {$car_type}, precio: {$car_price} cuc
</br></br>

Información del cliente:
</br></br>
Nombre: {$reserve['name']}
</br>
Mail: {$reserve['email']}
</br>
Número de pasajeros: {$reserve['persons']}
</br>
Fecha del tour: {$reserve['date']}, hora {$reserve['time']}
</br>
Lugar de recojida: {$reserve['location']}
</br>
";
if($reserve['phone'])
    $message .= "Teléfono: {$reserve['phone']}</br>";
if($reserve['note'])
    $message .= "Nota: {$reserve['note']}";
$message .= "</br></br>Total a pagar: {$reserve['total']} cuc";
