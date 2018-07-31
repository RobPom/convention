{{$timeslot->start_time()->format('l')}}  
{{ 
    $timeslot->start_time()->minute == 0 ? 
    $timeslot->start_time()->format('ga') : 
    $timeslot->start_time()->format('g:ia')
}}
to
{{ 
    $timeslot->end_time()->minute == 0 ? 
    $timeslot->end_time()->format('ga') : 
    $timeslot->end_time()->format('g:ia')
}}