<?php

namespace RobBrazier\Piwik\Module;

/**
 * Class SitesManagerModule.
 *
 * @see https://developer.matomo.org/api-reference/reporting-api#SitesManager for arguments
 */
class UsersManagerModule extends Module
{
    /**
     * @param string $group group to search for
     * @param string $format override format (defaults to one specified in config file)
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

    public function addUser($userLogin, $password, $email, $alias = '', $format = null)
    {
        {
            $arguments = [
                'userLogin' => $userLogin,
                'password' => $password,
                'email' => $email,
                'alias' => $alias,
            ];
            $options = $this->getOptions($format)
                ->useSiteId(false)
                ->usePeriod(false)
                ->setArguments($arguments);

            return $this->request->send($options);
        }

    }
}
