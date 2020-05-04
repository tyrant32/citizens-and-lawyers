<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Response;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        return redirect(route(Auth::user()->role->slug.'.appointments'));
    }
}
