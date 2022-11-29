<?php

declare(strict_types=1);

namespace RLTSquare\Training\Controller;

use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Route\ConfigInterface;
use Magento\Framework\App\Router\ActionList;
use Magento\Framework\App\RouterInterface;
use Magento\Framework\Message\ManagerInterface;
use ReflectionException;

/**
 * Custom Router Class
 */
class Router implements RouterInterface
{
    /**
     * @var ActionFactory
     */
    private ActionFactory $actionFactory;

    /**
     * @var ActionList
     */
    private ActionList $actionList;

    /**
     * @var ConfigInterface
     */
    private ConfigInterface $routerConfig;

    /**
     * @var ManagerInterface
     */
    private ManagerInterface $messageManager;

    /**
     * @param ActionFactory $actionFactory
     * @param ActionList $actionList
     * @param ConfigInterface $routerConfig
     * @param ManagerInterface $messageManager
     */
    public function __construct(
        ActionFactory    $actionFactory,
        ActionList       $actionList,
        ConfigInterface  $routerConfig,
        ManagerInterface $messageManager
    ) {
        $this->actionFactory = $actionFactory;
        $this->actionList = $actionList;
        $this->routerConfig = $routerConfig;
        $this->messageManager = $messageManager;
    }

    /**
     * @param RequestInterface $request
     *
     * @return ActionInterface|null
     */
    public function match(
        RequestInterface $request
    ): ?ActionInterface {
        $modules = $this->routerConfig->getModulesByFrontName('training');
        $actionInstance = null;
        if (empty($modules)) {
            return null;
        }

        try {
            $actionClassName = $this->actionList->get($modules[0], null, 'index', 'index');
            $actionInstance = $this->actionFactory->create($actionClassName);
        } catch (ReflectionException $e) {
            $this->messageManager->addErrorMessage('Error:' . $e->getMessage());
        }
        return $actionInstance;
    }
}
