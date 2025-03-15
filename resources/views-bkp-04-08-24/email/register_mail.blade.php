@extends('layouts.email')

@section('content')


<tr>
    <td valign="top" class="side title" style="padding: 0;">
        <table style="text-align: center; padding: 0 15px;">
            <tr>
                <td style="color: #000;font-size: 28px;line-height: 22px;font-weight: bold; padding: 20px 0;">
                    Hello {{ isset($name) ? $name : ''}},
                </td>
            </tr>
            <tr>
               <td style="color: #000;font-size: 18px;line-height: 18px;font-weight: 500;padding:0;margin: 0;">
                    Thanks for registering Diamond Sutra,
                </td>
            </tr>
            <tr>
                <td style="text-align: center; padding: 40px 0;" colspan="4">
                    <a href="{{url('');}}" style="text-decoration: none; font-size: 16px;color: #fff; padding: 12px 20px; border-radius: 30px; background-color: #000;">view
                        Learn More</a>
                </td>
            </tr>
            <tr>
                <td style="color: #000;font-size: 16px;line-height: 22px;font-weight: normal;">
                    <h3 style="margin: 0px;">{{config('constant.PLATFORM_NAME')}}</h3>
                </td>
            </tr>

        </table>
    </td>
</tr>


@stop