<?PHP

namespace application\views;

class View
{

    function generate($viewContent, $viewTemplate, $data = null)
    {
        include 'application/views/'.$viewContent;
    }

}

