<?php
namespace App\Controller;
use App\Model\ItemManager;

class ItemController extends Controller
{
	public function getItems(): void
	{
		$itemManager = new ItemManager();
		$items = $itemManager->getItems();

		parent::view('items', ['items' => $items]);
	}

	public function getItem(int $id): void
	{
		$itemManager = new ItemManager();
		$item = $itemManager->getItem($id);

		parent::view('item', ['item' => $item]);
	}
}