<?php

class GoogleReserve
{
    // monitoraggio del mio server di prenotazione
    public function healthCheck()
    {
        $res['status'] = 'serving';
        return json_encode($res); 
    }

    // verifica che gli intervalli di appuntamenti richiesti siano attualmente
    // validi e disponibili
    public function checkAvailability($request)
    {
        $req = json_decode($request, true);
        $resp = [
            'merchant_id' => $req['merchant_id'],
            'slot_time' => $req['lot_time'],
            'reserved' => $req['reserved'],
            'slot_time_availability' => $req['slot_time_availability'],
            'service_id' => $req['service_id'],
            'start_sec' => $req['start_sec'],
            'resource_ids' => $req['resource_ids'],
            'available' => $req['available'],
            'duration_requirement' => 'DURATION_REQUIREMENT_UNSPECIFIED'
          ];
          return json_encode($resp);
    }

    // il client richiede di prenotare una prenotazione, il backend effettua una prenotazione
    public function createBooking($request)
    {
        $req = json_decode($request, true);

        $resp['booking'] = [
            'booking_id' => $req['booking_id'],
            'slot' => $req['slot'],
            'user_information'=>['user_id' => $req['user_information']['user_id']],
            'payment_information' => $req['payment_information'],
            'status' => 'CONFIRMED'
        ];
        return json_encode($resp);
    }

    // il client utilizza updateBooking per modificare o cancellare una prenotazione
    function updateBooking($request) {
        $req = json_decode($request, true);
        $resp['booking'] = [
            'booking_id' => $req['booking']['booking_id'],
            'status' => $req['booking']['status']
        ];
        return json_encode($resp);
    }

    // restituisce uno stato di prenotazione per un untente in base all'id di prenotazione
    function getBookingStatus($request) {
        $req = json_decode($request, true);
        $resp = [
          'booking_id' => $req['booking_id'],
          'booking_status' => 'BOOKING_STATUS_UNSPECIFIED'
        ];
        return json_encode($resp);
    }

    // 



}