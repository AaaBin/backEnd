@component('mail::message')


<table>
    <tr>
        <td>
            {{$contact_data->name}}contact us
        </td>
        <td>
            content:{{$contact_data->question}}
        </td>
        <td>
            email:{{$contact_data->email}}
        </td>
        <td>
            phone:{{$contact_data->phone}}
        </td>
        <td>
            SendMeMail:{{$contact_data->SendMeMail}}
        </td>
    </tr>
</table>




@endcomponent
