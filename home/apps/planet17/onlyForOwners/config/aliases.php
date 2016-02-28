<?php /** User: planet17 Date: 26.02.16 Time: 0:06 */
/** Set a GLOBAL alias @root_namespace for Vanparts-apps */
Yii::setAlias('@planet17', helpers_pl17_dir_get(__DIR__, 2));
Yii::setAlias('@path-www', helpers_pl17_dir_get(__DIR__, 5,['www']));
Yii::setAlias('@link-www-common', '/common');
Yii::setAlias('@path-www-common', Yii::getAlias('@path-www') . DIRECTORY_SEPARATOR . 'common');