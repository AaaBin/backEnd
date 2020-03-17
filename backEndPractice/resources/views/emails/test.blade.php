@component('mail::message')


<table>
        <tr>
            Customer: '{{$contact_data->name}}' contact us
        </tr>
        <tr>
            content:{{$contact_data->question}}
        </tr>
        <tr>
            {{$contact_data->email}}
        </tr>
        <tr>
            phone:{{$contact_data->phone}}
        </tr>
        <tr>
            SendMeMail:{{$contact_data->SendMeMail}}
        </tr>
</table>




@endcomponent
