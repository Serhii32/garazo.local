<?php

use Illuminate\Database\Seeder;
use App\SEO_Page;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $page = new SEO_Page();
        $page->page = "Главная";
	    $page->save();

	    $page = new SEO_Page();
        $page->page = "Товары и услуги";
	    $page->save();

	    $page = new SEO_Page();
        $page->page = "О нас";
	    $page->save();

	    $page = new SEO_Page();
        $page->page = "Контакты";
	    $page->save();

	    $page = new SEO_Page();
        $page->page = "Доставка и оплата";
	    $page->save();

	    $page = new SEO_Page();
        $page->page = "Новости";
	    $page->save();

	    $page = new SEO_Page();
        $page->page = "Акции";
	    $page->save();

	    $page = new SEO_Page();
        $page->page = "Корзина";
	    $page->save();

	    $page = new SEO_Page();
        $page->page = "Оформить заказ";
	    $page->save();

	    $page = new SEO_Page();
        $page->page = "Поиск";
	    $page->save();
    }
}
