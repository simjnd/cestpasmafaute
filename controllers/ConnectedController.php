<?php
namespace CPMF\Controller;

use CPMF\Models\UserManager;

class ConnectedController extends Controller
{
	public function connectedPage(): void
	{
		session_start();
		$connected = $_SESSION['connected'] ?? NULL;
		$email = $_SESSION['email'] ?? NULL;
		if($connected && $email) {
			parent::view('connected', ['email' => $email]);	
		} else {
			parent::redirect('/');
		}
	}	
}
