Yii Console Rbac manager
==================

What RbacCommand can do
==================
1. Add/Update/Remove role/task/operation
2. Print list/tree
3. Assign/Revoke role/task/operation to user
4. Add/Remove child

How to use
==================
1. Put files in protected/extensions/consolerbac/
2. In config/console.php put following lines
```php
	'commandMap' => array(
		'rbac' => 'ext.ConsoleRbac.RbacCommand',
	),
```

3. Run ./yiic help rbac

Example of output
==================
```
$ yiic help rbac
Usage: ./protected/yiic rbac <action>
Actions:
    create --type=value --name=value [--description=] [--rule=]
    update --name=value [--newName=] [--newDescription=] [--newRule=]
    remove --name=value
    list
    tree [--roots=Array()] [--lists=Array()]
    assign --name=value --id=value [--rule=]
    revoke --name=value --id=value
    addChild --parent=value --child=value
    removeChild --parent=value --child=value
```

```
$ yiic rbac tree
roles
├── [role]admin
├── [role]developer
        └── [operation]executeMysql
├── [role]uploader
        └── [task]manageApplications
                ├── [operation]addApplication
                ├── [operation]deleteApplication
                └── [operation]updateApplication
└── [role]user
```
