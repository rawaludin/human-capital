<?php

class BaseController extends Controller
{
    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if ( ! is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    /**
     * Redirect if input model not validated, only applicable for model
     * which extends Morphaworks\Database\Model
     * @param  Morphaworks\Database\Model $model Model validated
     * @return [type]                     Redirect to previous URL with error message
     */
    protected function formError(Morphaworks\Database\Model $model)
    {
        $messages = json_decode($model->getErrors(),true);
        $message = '<ul>';
            foreach ($messages as $key => $value) {
                $message .= '<li>' . $value[0] . '</li>'; // append
            }
        $message .= '</ul>';

        return Redirect::back()
            ->with('error-message', $message)->withInput( Input::input() );
    }

    /**
     * Generate previous URL for a form based on various referer URL
     * This function also set message named 'prevURL', which will be
     * accessed by corresponding store/update function.
     * @param  string $defaultUrl Default previous url
     * @return string Previous URL
     */
    public function getPreviousUrl($defaultUrl)
    {
        if ( URL::previous() == URL::current() || URL::previous() == URL::to('/')) {
            // this page accessed directly (or this form yield error).
            // so, previous_url set to index page
            $previousUrl = $defaultUrl;
        } elseif ( URL::previous() != URL::to('/') ) {
            // this page accessed from link, but not from index page
            // so, previous_url set to previous page
            $redirect = Redirect::back();
            $previousUrl = $redirect->getTargetUrl();
        } else {
            $previousUrl = URL::previous();
        }
        Session::set('prevUrl', $previousUrl);

        return $previousUrl;
    }
}
