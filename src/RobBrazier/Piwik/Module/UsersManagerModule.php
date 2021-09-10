<?php

namespace RobBrazier\Piwik\Module;


/**
 * Class UsersManagerModule.
 *
 * @see https://developer.matomo.org/api-reference/reporting-api#UsersManager for arguments
 */
class UsersManagerModule extends Module
{
	/**
     * Gets the user's Authentication Token for Matomo V4
     *
     * @param string $userLogin user login
     * @param string $password user password
     * @param string $description description of the token, e.g. its usage
     * @param string $expireDate expire date of the token default: null
     * @param int $expireHours expire hours of the token default: 0
     * @param null $format override format (defaults to one specified in config file)
     *
     * @return mixed
     */
    public function createAppSpecificTokenAuth($userLogin, $password, $description, $expireDate = '', $expireHours = 0, $format = null)
    {
        $arguments = [
            'userLogin' => $userLogin,
            'passwordConfirmation' => $password,
            'description' => $description,
            'expireDate' => $expireDate,
            'expireHours' => $expireHours
        ];
        $options = $this->getOptions($format)
            ->useSiteId(false)
            ->usePeriod(false)
            ->setArguments($arguments);

        return $this->request->send($options);
    }
	
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
                $arguments += ['alias' => $alias];
            }
            if (isset($initialIdSite)) {
                $arguments += ['initialIdSite' => $initialIdSite];
            }
            $options = $this->getOptions($format)
                ->useSiteId(false)
                ->usePeriod(false)
                ->setArguments($arguments);

            return $this->request->send($options);
        }

    }
}
