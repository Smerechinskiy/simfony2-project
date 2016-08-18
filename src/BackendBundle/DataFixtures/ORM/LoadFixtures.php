<?php
/**
 * Created by PhpStorm.
 * User: Богдан
 * Date: 19.05.2016
 * Time: 21:44
 */

namespace BackendBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use BackendBundle\Entity\User;
use BackendBundle\Entity\Category;
use BackendBundle\Entity\Product;

class LoadFixtures extends AbstractFixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadUser($manager);
        $this->loadCategory($manager);
        $this->loadProduct($manager);
    }

    public function loadUser($manager)
    {
        $user = new User();
        $user->setUsername('Admin');
        $user->setPlainPassword('admin');
        $user->setEnabled(true);
        $user->setEmail('admin@gmail.com');
        $user->setRoles(array('ROLE_SUPER_ADMIN'));
        $manager->persist($user);

        $user = new User();
        $user->setUsername('Test');
        $user->setPlainPassword('test');
        $user->setEnabled(true);
        $user->setEmail('test@gmail.com');
        $user->setRoles(array('ROLE_CLIENT'));
        $manager->persist($user);

        $manager->flush();
    }

    public function loadCategory($manager)
    {
        $category = new Category();
        $category->setName('Первые блюда');
        $category->setDescription('Первые блюда актуальны в любое время года. Одни супы согреют и насытят в холодный зимний или осенний день, другие создадут весеннее настроение, а третьи подарят приятную свежесть в летний зной.');
        $manager->persist($category);
        $this->setReference('first_course', $category);

        $category = new Category();
        $category->setName('Вторые блюда');
        $category->setDescription('Вторые блюда являются незаменимой составляющей полноценного обеда и ужина. Почему эти блюда называются «вторые»? Всё просто — их подают к столу после супа.');
        $manager->persist($category);
        $this->setReference('second_course', $category);

        $category = new Category();
        $category->setName('Напитки');
        $category->setDescription('В летнюю жару, холод, что может быть лучше освежающего или согревающего напитка.');
        $manager->persist($category);
        $this->setReference('potable', $category);

        $category = new Category();
        $category->setName('Десерты');
        $category->setDescription('Десерт – блюдо, подаваемое в завершении основной трапезы. В обычный будний день порадует всех близких и сделает жизнь ярче и насыщеннее.');
        $manager->persist($category);
        $this->setReference('dessert', $category);

        $manager->flush();
    }

    public function loadProduct($manager)
    {

        $product = new Product();
        $product->setName('Мисо с угрём');
        $product->setDescription('Угорь, сыр тофу, бульон мисо, зеленый лук, кунжут, кунжутное масло, водоросли вакаме, грибы шиитаке');
        $product->setQuantity(220);
        $product->setPrice(45);
        $product->setPath('57593c689cff5.jpeg');
        $product->setCategory($this->getReference('first_course'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Суп гуляш');
        $product->setDescription('Бульон, телятина, томаты, зелень, перец, картофель');
        $product->setQuantity(250);
        $product->setPrice(35);
        $product->setPath('57593c7aee736.jpeg');
        $product->setCategory($this->getReference('first_course'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Крем-суп из брокколи');
        $product->setDescription('Масло Оливковое, брокколи, зелень, молоко, кнели из лосося');
        $product->setQuantity(230);
        $product->setPrice(45);
        $product->setPath('57593c87a62dd.jpeg');
        $product->setCategory($this->getReference('first_course'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Крем-суп из лесных грибов');
        $product->setDescription('Сливки, шампиньоны, лисички, белые грибы, белое вино');
        $product->setQuantity(250);
        $product->setPrice(37);
        $product->setPath('57593caa0e674.jpeg');
        $product->setCategory($this->getReference('first_course'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Сырный мисо с лососем и креветками');
        $product->setDescription('Лосось, шампиньоны, мисо бульон, кинза, лук-порей, тигровая креветка, кунжутное масло, сливочный сыр');
        $product->setQuantity(250);
        $product->setPrice(55);
        $product->setPath('57593cb46d91a.jpeg');
        $product->setCategory($this->getReference('first_course'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Суп Том ям кунг');
        $product->setDescription('Бульон, вешенки, томаты, кинза, сок лайма, лист лайма, тигровая креветка, кокосовое молоко, корень имбиря');
        $product->setQuantity(250);
        $product->setPrice(55);
        $product->setPath('57593cbdb1ceb.jpeg');
        $product->setCategory($this->getReference('first_course'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Карбонара');
        $product->setDescription('Тальятелле, пармезан, бекон, чеснок, лук, сливки, белое вино, желток');
        $product->setQuantity(250);
        $product->setPrice(45);
        $product->setPath('575949b93fc21.jpeg');
        $product->setCategory($this->getReference('second_course'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Тальятелле с курицей');
        $product->setDescription('Тальятелле, куриное филе, пармезан, маш-салат, помидоры черри');
        $product->setQuantity(300);
        $product->setPrice(55);
        $product->setPath('575949e3543b9.jpeg');
        $product->setCategory($this->getReference('second_course'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Стейк телятины с картофелем');
        $product->setDescription('Телятина, картофель, помидоры черри');
        $product->setQuantity(250);
        $product->setPrice(70);
        $product->setPath('575949f0d4885.jpeg');
        $product->setCategory($this->getReference('second_course'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Рис');
        $product->setDescription('Рис правой');
        $product->setQuantity(220);
        $product->setPrice(15);
        $product->setPath('575949feaebf2.jpeg');
        $product->setCategory($this->getReference('second_course'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Рис жаренный с овощами');
        $product->setDescription('Рис, лук репчатый, морковь, помидор, яйцо, пекинская капуста, древесные грибы, корень сельдерея, зеленый горошек');
        $product->setQuantity(220);
        $product->setPrice(30);
        $product->setPath('57594a0b692e3.jpeg');
        $product->setCategory($this->getReference('second_course'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Рис жаренный с курицей');
        $product->setDescription('Рис, лук, помидор, яйцо, куриное филе');
        $product->setQuantity(240);
        $product->setPrice(39);
        $product->setPath('57594a15d3400.jpeg');
        $product->setCategory($this->getReference('second_course'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Лапша со свининой');
        $product->setDescription('Ошеек свиной, лук, кунжут, омлет яичный, соевый соус, зеленый лук, пекинская капуста, соус рыбный, домашняя лапша');
        $product->setQuantity(300);
        $product->setPrice(47);
        $product->setPath('57594a2496ff2.jpeg');
        $product->setCategory($this->getReference('second_course'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Спагетти с балонезе');
        $product->setDescription('Телятина, спагетти, лук, морковь, помидор, розмарин, тимьян, красное вино');
        $product->setQuantity(230);
        $product->setPrice(50);
        $product->setPath('57594a326ecee.jpeg');
        $product->setCategory($this->getReference('second_course'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Рыбный стейк под винным соусом');
        $product->setDescription('Окунь, брокколи, картофель, морковь бейби');
        $product->setQuantity(265);
        $product->setPrice(68);
        $product->setPath('57594a3e628e9.jpeg');
        $product->setCategory($this->getReference('second_course'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Куриное филе фаршированное сыром');
        $product->setDescription('Моцарела, грибной соус, куриное филе, картофельное пюре');
        $product->setQuantity(300);
        $product->setPrice(58);
        $product->setPath('57594a49ba0f7.jpeg');
        $product->setCategory($this->getReference('second_course'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Узвар из вяленых фруктов');
        $product->setDescription('Сухофрукты (яблоко, груша, чернослив, абрикос), сахар, вода.');
        $product->setQuantity(500);
        $product->setPrice(10);
        $product->setPath('57594adac74c2.jpeg');
        $product->setCategory($this->getReference('potable'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Морс клюквенный');
        $product->setDescription('Клюква, сахар, вода.');
        $product->setQuantity(500);
        $product->setPrice(15);
        $product->setPath('57594ae32799c.jpeg');
        $product->setCategory($this->getReference('potable'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Морс малиново-смородиновый');
        $product->setDescription('Малина, смородина, сахар, вода.');
        $product->setQuantity(500);
        $product->setPrice(15);
        $product->setPath('57594aeb286b5.jpeg');
        $product->setCategory($this->getReference('potable'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Торт Наполеон');
        $product->setDescription('Тонкие слоеные коржи, пропитанные орехово-молочным кремом.');
        $product->setQuantity(150);
        $product->setPrice(15);
        $product->setPath('57594a5aac37a.jpeg');
        $product->setCategory($this->getReference('dessert'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Торт Пьяная вишня');
        $product->setDescription('Классический рецепт: шоколадный бисквит, щедро пропитанный ароматной вишневой настойкой с добавлением ягод пьяной вишни.');
        $product->setQuantity(160);
        $product->setPrice(25);
        $product->setPath('57594a63ca0a4.jpeg');
        $product->setCategory($this->getReference('dessert'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Пирог Ореховый');
        $product->setDescription('Открытый ореховый пирог: хрустящее донышко из песочного теста, орехово-сливочный наполнитель из обжаренного и измельченного грецкого ореха.');
        $product->setQuantity(200);
        $product->setPrice(30);
        $product->setPath('57594a7c9e526.jpeg');
        $product->setCategory($this->getReference('dessert'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Щербет «Клубника»');
        $product->setDescription('Вода, сахар, клубника.');
        $product->setQuantity(200);
        $product->setPrice(30);
        $product->setPath('57594a9318fa8.jpeg');
        $product->setCategory($this->getReference('dessert'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Мороженое «Фисташковое»');
        $product->setDescription('Молоко, сахар, фисташки.');
        $product->setQuantity(200);
        $product->setPrice(30);
        $product->setPath('57594a9e6ca11.jpeg');
        $product->setCategory($this->getReference('dessert'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Мороженое «Шоколадное»');
        $product->setDescription('Молоко, сливки, сахар, шоколад');
        $product->setQuantity(200);
        $product->setPrice(30);
        $product->setPath('57594ab1d976f.jpeg');
        $product->setCategory($this->getReference('dessert'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Мороженое сливочное «Карамель»');
        $product->setDescription('Молоко, сливки, сахар, карамель');
        $product->setQuantity(200);
        $product->setPrice(30);
        $product->setPath('57594ab1d976f.jpeg');
        $product->setCategory($this->getReference('dessert'));
        $manager->persist($product);

        $product = new Product();
        $product->setName('Мороженое «Сливочное»');
        $product->setDescription('Молоко, сливки, сахар');
        $product->setQuantity(200);
        $product->setPrice(30);
        $product->setPath('57594accd0d5d.jpeg');
        $product->setCategory($this->getReference('dessert'));
        $manager->persist($product);

        $manager->flush();
    }
}