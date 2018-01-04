1. 重载：
```
PHP中的重载说的是对类中不可以访问的成员的一种处理方法。此处的不可访问有两种情况：
情况1：类中没有所在访问的成员
情况2：所要访问的成员在类中不是public。
PHP自动处理机制，当我们程序执行了某种代码时，由php自动触发执行的机制。
```
2. php类的一个对象可以随意的向对象上添加不存在的属性，为了严谨考虑，我们限制这样的操作。
```
class A{
    private $name="123";
    public function __set($n,$v){
         echo $n,"<br/>",$v,"<br/>";
    }
    public function __get($n){
          echo 1231445,"<br/>";
          echo $n;
    }
}
$obj =new A();
$obj ->name ="lisi";
$obj ->age =20;
$obj->name;
当我们对类中的属性进行修改和查询的时候，会自动触发事件，比如__set和__get 的方法。同理PHP中还有类似的方法：__isset()和__unset()，empty()

```
3. 方法的重载：
```
①、__call()
语法：
	public function __call($fn,$args){
		//
}
说明：
	$fn		不可访问的方法名
	$args	不要访问的方法的实参数组
案例：
class A{
    private function getSum($args){
        return $args[0]+$args[1];
    }
    private function gettime($args){
       return $args[0]*$args[1]*$args[2];
    }
    public function __call($fn,$args){
      return $this -> $fn($args);
    }
}
$obj =new A;
echo $obj->getSum(10,20);
echo $obj->gettime(10,20,30);
②、__callstatic()
语法：
	public static function __callstatic($fn,$args){
		
}
还有一些比如：
__tostring()的方法
```
4. 类的自动加载
```
首先要实现自动加载，一般我们会约定好很多规则，比如，命名规则：
一般一个文件只保存一个类的定义。使用类的文件与定义类的文件不是同一个文件。
类文件命名规则：
	类名.class.php
	class.类名.php
	类名.php
当我们使用一个类时，这个类必须先存在，如果类不存在于当前文件，则需要引入这个类的定义文件。
1.自动加载函数
__autoload();
语法：
	function __autoload(name){
	// 执行命令
    }
说明：
	当php在使用一个类时，会由PHP自动执行机来调用这个预定义的__autoload()函数，同时会将所要使用的类的类名传递给__autoload()函数的形参。
	__autoload()仅是php给我们提供的一个时机，我们利用这个时机完成什么功能需要我们自己写代码实现。
spl_autoload_register(callback);
说明：
	将们自己定义的函数注册到php的自动加载机制中。也就是说只要通过spl_autoload_register函数注册的自定义的函数在，使用到一个类的时候，自定义的函数就像__autoload()一样被自动调用。
提示：
	一般我们会将命中率高的加载先注册。
```
5. 设计模式：对于设计模式的代码，我的common里面写有。
```
单例模式：
单例模式：所谓的单例模式就是单一的实例。通过一个类永远只能获取一个对象。
工厂模式：
所谓工厂模式就是一个类(Factory)负责为其他的类实例化对象
```
6 对象的遍历
```
对象的属性名与值类似于关联数组的键名与键值，对象从这个角度来看与关联数组很相似，所以php中的对象可以使用foreach进行遍历public的属性。
当对一个对象使用foreach时默认是对公有属性的遍历，但公有属性的遍历没有实际的意义，在很多的框架中是允许对某个对象中的私有的属性的遍历。
一般这个私有属性中存储的数据库中读取出来的数据。如何实现呢了，php中提供了一个预定义的接口——iterator.
示例：
class CLS implements iterator{
    public $name='zhangsan';
    public $age=20;
    private $data=['brand'=>'huawei','channel'=>'4G','goodsName'=>'mate10','price'=>3000];

    //实现接口
    public function current(){
    	return current($this->data);
    	//echo __METHOD__,'<br/>';
    }
	public function key(){
		return key($this->data);
		//echo __METHOD__,'<br/>';
	}
	public function next(){
		return next($this->data);
		//echo __METHOD__,'<br/>';
	}
	public function rewind(){
		return reset($this->data);
		//echo __METHOD__,'<br/>';
	}
	public function valid(){
		return !is_null(key($this->data));
		//echo __METHOD__,'<br/>';
	}
}
$obj = new CLS();
foreach($obj as $p=>$v){
	echo $p,'=>',$v,'<br/>';
}
执行结果为：
brand=>huawei
channel=>4G
goodsName=>mate10
price=>3000

```
7. 命名空间的使用：
```
命名空间的作用：在PHP中函数、类、常量是不允许同名的。为了解决这三者的同名问题，所以出现了命名空间。
语法：
	namespace 空间名\空间名;
说明：
	用于定义空间名
	如果一个php文件中，第一个空间的定义义必须放在第1行。
	如果所要定义的空间已存在，则是进入空间。
    空间成员就是，空间所影响的，空间只影响类、函数、常量(const)
示例：
namespace AA\BB;
function showInfo(){
	echo __METHOD__,'<br/>';
}

namespace CC;
function showInfo(){
	echo __METHOD__,'<br/>';
}

namespace AA;
function showInfo(){
	echo __METHOD__,'<br/>';
}
非限定访问：用于访问当前空间中的成员
showInfo();
限定访问：只能访问当前所在空间的子空间中成员
BB\showInfo();
完全限定访问：可以访问其他所有的空间的成员
\CC\showInfo();


在实际开发中，我们经常会在一个文件中引入另一个php文件。
情况1：
	当前文件有空间的定义，被引入的文件中没有空间的定义，但是有空间成员。被引入的空间成员会被放在公共空间(根空间)。根空间中的成员,只要类的访问必须加\.
情况2：
	当前文件有空间的定义，被引入的文件中有空间的定义，并不会中断当前空间的定义。
引入空间成员：
语法1：
	use 空间名\空间名 【as 别名】 
说明：
	将指定空间引入到当前空间。同可以使用as关键字为被引入的空间起个别名。
namespace Core;
use Admin\Controller\AdminController;


include '05outer.php';
new AdminController();
05outer文件中的代码：
namespace Admin\Controller;
class AdminController{
	public function __construct(){
		echo __METHOD__,'<br/>';
	}
}

语法2：
	use 空间名\空间名\成员类 【as 别名】
说明：
	将指定的空间中的成员引入到当前空间，引入空间成员只能引入类。
提示：空间名我们可以任意的定义，但是如果命名更有意义呢。一般我们会以类文件所在的文件夹为空间名。
```
8. 数据的保存：序列化和反序列化

```
程序语言中对数据划分了很多的类型，但数据与之相关的有两个方面：其一是值，其二是类型。程序在运算的过程中，会产生数据，但程序执行结束内存中的数据都会丢失。如果想保存程序执行过程中产生数据，要保存起来。保存的位置文本文件或数据库。但是文本文件中只能保存字符信息。为了将数据的数据与类型一同保存到文本文件中，而不致于丢失类型。所以有序列化技术。
将数据的值与类型都使用字符串的描述。
seralize(v);

对序列化后的字符串进行一个返序列化操作，就是为了得到原数据。
unserialize(v);

对象的序列化与反序列化：
①、对象的序列化
对象中只有属性才可以被序列化，原因是属性才是保存在对象空间，方法是保存在类空间。
默认对象的序列化会将所有的属性都进行序列化，如果想指定序列化的属性们可以使用__sleep().
语法：
	public function __sleep(){
		return arr
}
说明：
	__sleep是在当一个对象被序列化时调用。
	arr是一个数组，数组的元素是属性名。
	只要属性名存在于arr数组中的属性者会被序列化。
②、对象的反序列化
对象在返回序列化时，构造方法并不会被自动运行。如果序列化之前的对象在构造方法中执行了资源的获取操作，那么在反序列化时会资源会丢失。所以在反序列化时，我们要再次将构造方法中没有执行的方法再执行一次。
__wakeup();
语法：
	function __wakup(){
		//所要调用的方法
}
说明：
	__wakeup特点，在对对象进行反序列时自动执行。
小节：
	serialize()			(为了保存数据)可以对所有的数据进行序列化(除资源类型)
	unserialize()			(为还原数据)

	对象的反序列化		当前脚本中必须有原类的定义。
```
9. 反射机制：
```
反射一词，形象的说明了一个类的作用。通过一种类，去窥探另一个类的全部的信息。
①、export方法
接收一个类或对象作为参数。作用是获取类或对象所在的类的所有的信息。
一次性将所有的类的信息都读取出来。我们经常进行操作是有针对性的获取，那么可以使用ReflectionClass为我们提供针对性的函数
示例：
class A{
	private function __clone(){}
}
echo '<pre>';
//创建反射对象
$ref = new ReflectionClass('A');

//利用反射类的对象，来实例化对象
$obj = $ref -> newinstance();
var_dump($obj);
②、反射类对象
反射类的对象就是ReflectionClass类的一个实例，这个实例对象是用于获取所我们所要窥探的类的服务对象。（类比）
new ReflectionClass(p);
说明：
	p是所要窥探的类
	new  ReflectionClass得的对象者反射类对象。
```
10. 异常的处理：

```
try{
	//try块
	throw()
}catch(异常类 异常类的对象){
	//catch块
}
说明：
	try块是可能出现错误(异常)的代码段
	throw						
抛出异常对象(错误对象，对象错误上附带错误信息)
			一个try中可以抛出多种异常对象。

	catch(异常类 异常类的对象)	
			捕获与异常类相对应的对象
	
catch块
		用于对捕获到的异常进行处理
```
