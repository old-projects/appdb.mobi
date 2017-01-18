Cli Tree Manager
==================
This is an yii extension that provides functionality for manage trees via console. For making trees you need use NestedSetBehavior extension.
The extensions uses NcursesObjects so you need to clone it too.

How to use
==================
1. Clone repos
```
git submodule add https://github.com/wapmorgan/NcursesObjects.git protected/extensions/NcursesObjects
git submodule add https://github.com/wapmorgan/CliTreeManager.git protected/extensions/CliTreeManager
```

2. In config/console.php put following lines
```php
	'commandMap' => array(
		'treeManager' => 'ext.CliTreeManager.TreeManagerCommand',
	),
```

3. Modify your model to implement ManagableTreeModel interface (include interface file and add "titleAttribute" function)
```php
Yii::import('ext.CliTreeManager.ManagableTreeModel');
class *your model name* extends CActiveRecord implements ManagableTreeModel {
...
	public function titleAttribute() {
		return 'name'; // a title attribute
	}
}
```

4. Run via console with class path
```
./yiic treeManager --class=application.modules.applications.models.ApplicationCategory
```

5. Hit "h" for help
