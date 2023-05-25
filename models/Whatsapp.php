<?php
/* TODO: llamada de las clases necesarias que se usarán en el envío del correo */
require_once("../config/conexion.php");
require_once("../Models/Ticket.php");

class Whastapp extends Conectar{
    // Variables de configuración
    private $apiURL = 'https://graph.facebook.com/v16.0/113492004941110/messages';
    private $token = 'EAAFlbvoSH6YBAPbTsLnFZBrunEYDatQZBjLrwMwzSjjFpCQqZAzKzgTnaooyCeTtCZCfPtn9QVoBVtKRju3liNMdeV8Qm4nwmeArZB6FUGNsyLr1ZBEvUAXq7SZARoYMeugbXOVKfVI5MEHrKI9596ZA42BFX8qFLg1ybZCWfAdGZA11bdXZB39YxFuNDd77CZCdGgMa2VLZCXOgTSwZDZD';

    /* TODO: Enviar alerta por Whatsapp de ticket Abierto */
    public function w_ticket_abierto($tick_id){
        $ticket = new Ticket();
        $datos = $ticket->listar_ticket_x_id($tick_id);
        foreach ($datos as $row){
            $id = $row["tick_id"];
            $titulo = $row["tick_titulo"];
            $categoria = $row["cat_nom"];
            $subcategoria = $row["cats_nom"];
            $telefono = $row["usu_telf"];
        }

        /* TODO: Generar JSON */
        $data = json_encode(
            array(
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $telefono,
                'type' => 'text',
                'text' => array(
                    'preview_url' => false,
                    'body' => "¡Hola! Te informamos que se ha abierto un nuevo ticket.\n\nID: $id\nTítulo: $titulo\nCategoría: $categoria\nSubcategoría: $subcategoria"
                )
            )
        );

        $url = $this->apiURL;
        $options = stream_context_create(
            array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => "Content-type: application/json\r\n" .
                                 "Authorization: Bearer ".$this->token."\r\n",
                    'content' => $data
                )
            )
        );

        $response = file_get_contents($url, false, $options);
        echo $response;
        exit;
    }

    /* TODO: Enviar alerta por Whatsapp de ticket Cerrado */
    public function w_ticket_cerrado($tick_id){
        $ticket = new Ticket();
        $datos = $ticket->listar_ticket_x_id($tick_id);
        foreach ($datos as $row){
            $id = $row["tick_id"];
            $titulo = $row["tick_titulo"];
            $telefono = $row["usu_telf"];
        }

        /* TODO: Generar JSON */
        $data = json_encode(
            array(
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $telefono,
                'type' => 'text',
                'text' => array(
                    'preview_url' => false,
                    'body' => "¡Hola! Te informamos que el ticket ha sido cerrado.\n\nID: $id\nTítulo: $titulo"
                )
            )
        );

        $url = $this->apiURL;
        $options = stream_context_create(
            array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => "Content-type: application/json\r\n" .
                                 "Authorization: Bearer ".$this->token."\r\n",
                    'content' => $data
                )
            )
        );

        $response = file_get_contents($url, false, $options);
        echo $response;
        exit;
    }

    /* TODO: Enviar alerta por Whatsapp de ticket Asignado */
    public function w_ticket_asignado($tick_id){
        $ticket = new Ticket();
        $datos = $ticket->listar_ticket_x_id($tick_id);
        foreach ($datos as $row){
            $id = $row["tick_id"];
            $titulo = $row["tick_titulo"];
            $telefono = $row["usu_telf"];
        }

        /* TODO: Generar JSON */
        $data = json_encode(
            array(
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $telefono,
                'type' => 'text',
                'text' => array(
                    'preview_url' => false,
                    'body' => "¡Hola! Te informamos que se ha asignado un agente al ticket.\n\nID: $id\nTítulo: $titulo"
                )
            )
        );

        $url = $this->apiURL;
        $options = stream_context_create(
            array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => "Content-type: application/json\r\n" .
                                 "Authorization: Bearer ".$this->token."\r\n",
                    'content' => $data
                )
            )
        );

        $response = file_get_contents($url, false, $options);
        echo $response;
        exit;
    }

    /* TODO: Enviar alerta por Whatsapp de ticket Respondido */
    public function w_ticket_respuesta($tick_id){
        $ticket = new Ticket();
        $datos = $ticket->listar_ticket_x_id($tick_id);
        foreach ($datos as $row){
            $id = $row["tick_id"];
            $titulo = $row["tick_titulo"];
            $categoria = $row["cat_nom"];
            $telefono = $row["usu_telf"];
        }

        /* TODO: Generar JSON */
        $data = json_encode(
            array(
                'messaging_product' => 'whatsapp',
                'recipient_type' => 'individual',
                'to' => $telefono,
                'type' => 'text',
                'text' => array(
                    'preview_url' => false,
                    'body' => "¡Hola! Te informamos que hay una nueva respuesta en el ticket.\n\nID: $id\nTítulo: $titulo\nCategoría: $categoria"
                )
            )
        );

        $url = $this->apiURL;
        $options = stream_context_create(
            array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => "Content-type: application/json\r\n" .
                                 "Authorization: Bearer ".$this->token."\r\n",
                    'content' => $data
                )
            )
        );

        $response = file_get_contents($url, false, $options);
        echo $response;
        exit;
    }
}
?>
