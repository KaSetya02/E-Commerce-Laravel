<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Newsletter;
class SubscribeController
{

    public function subscribe(Request $request)
    {
        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return "Die eingegebene Email ist nicht gültig.";
        } else {
            if (Newsletter::isSubscribed($request->email)) {
                return "Du bist bereits mit dieser Mail in meiner Mailingliste eingetragen.";
            } else {
                if (!(Newsletter::subscribeOrUpdate($request->email))) {
                    return "Leider gab es ein Problem, bitte versuche es später noch einmal.";
                } else {
                    return "Ihre Email " . $request->email . " wurde zu meiner Mailingliste hinzugefügt.";
                }
            }
        }
    }
}