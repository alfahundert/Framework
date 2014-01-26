<?php
define("PATH_APPLICATION", PATH_ROOT . 'application' . DS);
define("PATH_CONFIGS", PATH_ROOT . 'configs' . DS);
define("PATH_LANGUAGES", PATH_ROOT . 'languages' . DS);
define("PATH_LIBRARY", PATH_ROOT . 'library' . DS);
define("PATH_LOGS", PATH_ROOT . 'logs' . DS);
define("PATH_PUBLIC", PATH_ROOT . 'public' . DS);

define("PATH_EXCEPTION_LOG", PATH_ROOT . 'logs' . DS . 'exceptions.log');
define("PATH_ERROR_LOG", PATH_ROOT . 'logs' . DS . 'errors.log');

define("PATH_DEFAULT_VIEWS", PATH_APPLICATION . ucfirst(DEFAULT_CONTROLLER) . DS . 'views' . DS);
define("PATH_VIEW_HEADER", PATH_DEFAULT_VIEWS . 'header.phtml');
define("PATH_VIEW_FOOTER", PATH_DEFAULT_VIEWS . 'footer.phtml');