<?php

namespace RobBrazier\Piwik\Module;

use Illuminate\Support\Arr;

/**
 * Class UsersManagerModule.
 *
 * @see https://developer.matomo.org/api-reference/reporting-api#UsersManager for arguments
 */
class UsersManagerModule extends Module
{
    /**
     * Gets the user's Authentication Token
     * 
     * @param string $userLogin   user login
     * @param string $md5Password md5 hashed password
     * @param string $format      override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function getTokenAuth($userLogin, $md5Password, $format = null)
    {
        $arguments = [
            'userLogin' => $userLogin,
            'md5Password' => $md5Password
        ];
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false)
            ->setArguments($arguments);

        return $this->request->send($options);
    }

    /**
     * Assign an access role to a specified user for one or many site ids
     * 
     * @param string $userLogin  user login
     * @param string $access     user access role ({@see https://matomo.org/docs/manage-users/#advanced-user-management})
     * @param array $idSites     site ids to give the user access to
     * @param string $format     override format (defaults to one specified in config file)
     */
    public function setUserAccess($userLogin, $access, $idSites, $format = null)
    {
        {
            $arguments = [
                'userLogin' => $userLogin,
                'access' => $access,
                'idSites' => $idSites,
            ];
            $options = $this->getOptions($format)
                ->useSiteId(false)
                ->usePeriod(false)
                ->setArguments($arguments);

            return $this->request->send($options);
        }

    }

    /**
     * Create a user
      * 
     * @param string $userLogin     user login
     * @param string $password      user password
     * @param string $email         user email
     * @param string $alias         user alias (optional)
     * @param string $initialIdSite initial site id to give access to
     * @param string $format        override format (defaults to one specified in config file)
     */
    public function addUser($userLogin, $password, $email, $alias = null, $initialIdSite = null, $format = null)
    {
        {
            $arguments = [
                'userLogin' => $userLogin,
                'password' => $password,
                'email' => $email,
            ];
            if (isset($alias)) {
                $arguments = Arr::add($arguments, 'alias', $alias);
            }
            if (isset($initialIdSite)) {
                $arguments = Arr::add($arguments, 'initialIdSite', $initialIdSite);
            }
            $options = $this->getOptions($format)
                ->useSiteId(false)
                ->usePeriod(false)
                ->setArguments($arguments);

            return $this->request->send($options);
        }

    }
}
