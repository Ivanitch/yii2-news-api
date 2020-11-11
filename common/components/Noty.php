<?

namespace common\components;
/**
 * https://ned.im/noty/#/
 * https://github.com/needim/noty
 * https://daneden.github.io/animate.css/
 * A Dependency-free notification library
 * Class Noty
 */
class Noty
{
    public static $notyTypes = [
        'error'   => 'error',
        'success' => 'success',
        'info'    => 'info',
        'warning' => 'warning'
    ];

    public static function run()
    {
        $session = \Yii::$app->session;

        $flashes = $session->getAllFlashes();
        foreach ($flashes as $type => $flash) {

            if (!isset(self::$notyTypes[$type])) {
                continue;
            }
            foreach ((array) $flash as $i => $message) {
                $js = '
                    new Noty({
                      type: '."\"$type\"".',
                      text: '."\"$message\"".',                            
                      theme: "metroui", 
                      timeout: 3000,                                     
                      animation: {
                        open: "animated bounceInRight", 
                        close: "animated bounceOutRight"
                      }
                    }).show();
                    ';
            }

            \Yii::$app->view->registerJs($js, \Yii::$app->view::POS_END);
            $session->removeFlash($type);
        }
    }
}