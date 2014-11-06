<?php 
class PageController extends BaseController {

	protected $layout = 'layout.main';
    protected $user;

    // For Future Use
    public function __construct(Illuminate\Support\Facades\Auth $auth)
    {
        $this->user = $auth::User();
    }

    /*public function setUser(User $user)
    {
        $this->user = $user;
    }*/

	public function missingMethod($parameters = array())
	{
		$layout->title = 'Not Found';
		$layout->content = View::make("errors.missing")->with('exception', 'Page Not Found!');
		return Response::make($layout, 404);
	}
}