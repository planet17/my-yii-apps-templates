<?php
/**
 * User: planet17
 * Date: 26.02.16
 * Time: 0:06
 */
/** TODO NEED FULL TEST AND REWRITE!!! DON'T USE THAT */
/** Path to @apps directory */
Yii::setAlias('@path-apps', helpers_pl17_dir_get(__DIR__, 3));

/** Set a GLOBAL alias @root_namespace for Vanparts-apps */
Yii::setAlias('@samDark', helpers_pl17_dir_get(__DIR__, 2));

/** Path to @common_apps_directory */
Yii::setAlias('@path-common', Yii::getAlias('@path-apps') . DIRECTORY_SEPARATOR . 'common');
Yii::setAlias('@path-common-config', Yii::getAlias('@path-common') . DIRECTORY_SEPARATOR . 'config');

/** Path to @root_directory of website */
Yii::setAlias('@path-www', helpers_pl17_dir_get(__DIR__, 5,['www']));
Yii::setAlias('@link-www-common', '/common');
Yii::setAlias('@path-www-common', Yii::getAlias('@path-www') . DIRECTORY_SEPARATOR . 'common');