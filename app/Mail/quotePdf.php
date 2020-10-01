<?php

namespace App\Mail;

use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Jobs\sendmail;

class quotePdf extends Mailable implements ShouldQueue
{


    use Queueable, SerializesModels;

    public   $name , $phone , $email , $price ,$descreption, $service ;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name , $phone , $email , $price , $descreption ,$service)
    {
        //
        $this->name=$name;
        $this->phone=$phone;
        $this->email=$email;
        $this->price=$price;
        $this->descreption=$descreption;
        $this->service=$service;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->view('pdf')->with('name','email','phone','descreption','service' , 'price')
         ->subject('NextCRM Quote ');   
       
         
    }
}
