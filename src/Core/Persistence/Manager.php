<?php
  namespace Foxx\Library\Core\Persistence;

  use Foxx\Library\Core\Exception\MissingFileConstExeption;

  /**
   * Manager
   * 
   * Is an abstract class that forms the base for all presistence managers
   * 
   * @package Foxx\Library\Core\Persistence
   * @abstract
   * @author Foxx Azalea Pinkerton
   */
  abstract class Manager {

    /**
     * @var bool DEBUG If the manager is in debug mode
     */
    const DEBUG = true;
    
    /**
     * __construct
     * 
     * Is a function that checks if the constant FILE is defined on the subclass
     * 
     * @return void
     */
    public function __construct() {
      if(!defined('STATIC::FILE')) {
        throw new MissingFileConstExeption();
      }
    }
    
    protected abstract function save(): bool;
    protected abstract function load(): bool;

    public abstract function add(object $object): bool;
  }