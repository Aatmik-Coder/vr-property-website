<?php
use Cartalyst\Stripe\Stripe;
use App\Models\User;

function getStripeKey()
{
    $mode = config('constants.STRIPE_MODE');
    if(isset($mode) && $mode == "live"){
        $stripeKey = config('constants.STRIPE_PK_LIVE');
    }else{
        $stripeKey = config('constants.STRIPE_PK_TEST');
    }
    return $stripeKey;
}

function initialiseStripe()
{
    $mode = config('constants.STRIPE_MODE');
    if(isset($mode) && $mode == "live"){
        $stripe = Stripe::make(config('constants.STRIPE_SK_LIVE'));
    } else {
        $stripe = Stripe::make(config('constants.STRIPE_SK_TEST'));
    }
    return $stripe;
}

function createStripeCustomer($email)
{
    $message = '';
    $stripe = initialiseStripe();
    try {
        $customer = $stripe->customers()->create([
            'email' => strtolower($email),
        ]);
    }
    catch (\Cartalyst\Stripe\Exception\BadRequestException $e) {
        $message = $e->getMessage();
    }catch (\Cartalyst\Stripe\Exception\UnauthorizedException $e) {
        $message = $e->getMessage();
    }catch (\Cartalyst\Stripe\Exception\InvalidRequestException $e) {
        $message = $e->getMessage();
    }catch (\Cartalyst\Stripe\Exception\NotFoundException $e) {
        $message = $e->getMessage();
    }catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
        $message = $e->getMessage();
    }catch (\Cartalyst\Stripe\Exception\ServerErrorException $e){
        $message = $e->getMessage();
    }catch (\Exception $e){
        $message = $e->getMessage();
    }

    $retArr = [];
    if(isset($customer['id']) && $customer['id'] != "")
    {
        $retArr['stripe_customer_id'] = $customer['id'];
        $retArr['msg'] = $message;
        User::where('email',$email)->update(['stripe_customer_id'=>$customer['id']]);
    }
    else
    {
        $retArr['msg'] = $message;
    }
    return $retArr;
}

function addCardInStripe($stripe_customer_id,$stripeToken,$cname)
{
    $message = '';
    $stripe = initialiseStripe();
    try {
        $card = $stripe->cards()->create($stripe_customer_id, $stripeToken);
    } catch (\Cartalyst\Stripe\Exception\BadRequestException $e) {
        $message = $e->getMessage();
    }catch (\Cartalyst\Stripe\Exception\UnauthorizedException $e) {
        $message = $e->getMessage();
    }catch (\Cartalyst\Stripe\Exception\InvalidRequestException $e) {
        $message = $e->getMessage();
    }catch (\Cartalyst\Stripe\Exception\NotFoundException $e) {
        $message = $e->getMessage();
    }catch (\Cartalyst\Stripe\Exception\CardErrorException $e) {
        $message = $e->getMessage();
    }catch (\Cartalyst\Stripe\Exception\ServerErrorException $e){
        $message = $e->getMessage();
    }
    catch(Cartalyst\Stripe\Exception\MissingParameterException $e) {
        $message = $e->getMessage();
    }
    catch (\Exception $e){
        $message = $e->getMessage();
    }

    $retArr = [];
    if(isset($card['id']) && $card['id'] != "")
    {
        $stripe->cards()->update($stripe_customer_id, $card['id'], [
            'name' => ucwords($cname),
        ]);
        $defaultCard = $stripe->customers()->update($stripe_customer_id, [
            'default_source' => $card['id'],
        ]);

        $retArr['card_id'] = $card['id'];
        $retArr['msg'] = $message;
    }
    else
    {
        $retArr['msg'] = $message;
    }
    return $retArr;
}
