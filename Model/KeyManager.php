<?php

/**
 * @author Mygento Team
 * @copyright 2016-2019 Mygento (https://www.mygento.ru)
 * @package Mygento_Payment
 */

namespace Mygento\Payment\Model;

use Mygento\Payment\Api\Data\KeysInterface;
use Mygento\Payment\Model\ResourceModel\Keys\Collection;

class KeyManager implements \Mygento\Payment\Api\Data\KeyManagerInterface
{
    /**
     * @var \Mygento\Payment\Api\KeysRepositoryInterface
     */
    private $keyRepo;

    /**
     * @var \Mygento\Payment\Model\ResourceModel\Keys\CollectionFactory
     */
    private $keysCollection;

    /**
     * @var \Mygento\Payment\Api\Data\KeysInterfaceFactory
     */
    private $keysModel;

    /**
     * @var \Magento\Framework\UrlInterface
     */
    private $urlBuilder;

    /**
     * @param \Mygento\Payment\Api\KeysRepositoryInterface $keyRepo
     * @param \Mygento\Payment\Model\ResourceModel\Keys\CollectionFactory $keysCollection
     * @param \Mygento\Payment\Api\Data\KeysInterfaceFactory $keysModel
     * @param \Magento\Framework\UrlInterface $urlBuilder
     */
    public function __construct(
        \Mygento\Payment\Api\KeysRepositoryInterface $keyRepo,
        \Mygento\Payment\Model\ResourceModel\Keys\CollectionFactory $keysCollection,
        \Mygento\Payment\Api\Data\KeysInterfaceFactory $keysModel,
        \Magento\Framework\UrlInterface $urlBuilder
    ) {
        $this->keyRepo = $keyRepo;
        $this->keysCollection = $keysCollection;
        $this->keysModel = $keysModel;
        $this->urlBuilder = $urlBuilder;
    }

    /**
     * @param string $code
     * @param int|string $orderId
     * @return string
     */
    public function getLink(string $code, $orderId): string
    {
        $collection = $this->keysCollection->create();
        $collection->addFieldToFilter(KeysInterface::ORDER_ID, $orderId);
        $collection->addFieldToFilter(KeysInterface::CODE, $code);
        $collection->addOrder(KeysInterface::ID, Collection::SORT_ORDER_DESC);
        if ($collection->getSize() > 0) {
            $item = $collection->getFirstItem();

            return $this->urlBuilder->getUrl($code . '/payment/redirect/', [
                '_secure' => true,
                '_nosid' => true,
                'order' => $item->getHkey(),
            ]);
        }

        $key = $this->genHash($orderId);
        $newKeyModel = $this->keysModel->create();
        $newKeyModel->setData([
            KeysInterface::HKEY => $key,
            KeysInterface::CODE => $code,
            KeysInterface::ORDER_ID => $orderId,
        ]);
        $this->keyRepo->save($newKeyModel);

        return $this->urlBuilder->getUrl($code . '/payment/redirect/', [
            '_secure' => true,
            '_nosid' => true,
            'order' => $key,
        ]);
    }

    /**
     * @param string $code
     * @param string $link
     * @return bool|int
     */
    public function decodeLink(string $code, string $link)
    {
        $collection = $this->keysCollection->create();
        $collection->addFieldToFilter(KeysInterface::HKEY, $link);
        $collection->addFieldToFilter(KeysInterface::CODE, $code);
        $collection->addOrder(KeysInterface::ID, Collection::SORT_ORDER_DESC);
        if ($collection->getSize() == 0) {
            return false;
        }
        $item = $collection->getFirstItem();

        return $item->getOrderId();
    }

    /**
     * @param int|string $orderId
     * @return string
     */
    public function genHash($orderId): string
    {
        return strtr(base64_encode(microtime() . $orderId . rand(1, 1048576)), '+/=', '-_,');
    }
}
