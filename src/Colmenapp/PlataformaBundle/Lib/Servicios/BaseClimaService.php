<?php

namespace Colmenapp\PlataformaBundle\Lib\Servicios;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\ORM\EntityManager;
use Symfony\Component\DependencyInjection\ContainerInterface;

class BaseClimaService
{
    /**
     * @var string;
     */
    protected $urlClima;

    /**
     * @var string;
     */
    protected $apikeyClima;


    /**
     * @param EntityManager $em
     * @param $container
     * @param $doctrineService
     * @param $urlClima
     */
    function __construct(
        EntityManager $em,
        $container,
        $doctrineService,
        $urlClima,
        $apikeyClima)
    {
        $this->em        = $em;
        $this->container = $container;
        $this->doctrineService = $doctrineService;
        $this->urlClima = $urlClima;
        $this->apikeyClima = $apikeyClima;
    }

    /*
    public function getContentHtmlEmail()
    {
        if(!isset($this->email)){
            throw new \Exception("Error, email uninitialized");
        }

        $lsencrypt = new lsencrypt();
        $content = $this->email->getEmailHtmlContent();
        $systemController = new SystemController();

        if(isset($this->idEmailCampaign)){
            if(!isset(
                $this->contact,
                $this->trackerRoute,
                $this->trackingLink,
                $this->unsuscribeLink
            )){
                throw new \Exception("Error, uninitialized variables");
            }

            $content = $this->setCustomField($content,$this->contact);

            if (preg_match_all("/<a(.*?)href=\"(.*?)\"/is", $content, $matchs)) {

                $unique_matchs = array_unique($matchs[2]);

                foreach ($unique_matchs as $match) {

                    if (preg_match('/{landingpage}(.*?){landingpage}/', $match)) {

                        $content = $this
                            ->replaceLandingPageAndTracking(
                                $content,
                                $lsencrypt,
                                $systemController,
                                $match
                            );

                    } elseif ($match == "%email_public_url%") {

                        $content = $this
                            ->replaceEmailPublicUrlAndTracking(
                                $lsencrypt,
                                $systemController,
                                $content
                            );

                    } elseif ($match === "%unsuscribe%" || '%unsubscribe%' === $match ) {

                        if(!$this->isSystemTask) {

                            $trackClick = $lsencrypt
                                ->encrypt(
                                    $this->trackingLink . '&ev=click&p=unsubscribe&url=' . urlencode($this->unsuscribeLink)
                                );

                            $unsuscribeLink = $this->trackerRoute . "id=" . $trackClick;

                            $content = str_replace(
                                $match,
                                $unsuscribeLink,
                                $content
                            );

                        } else {
                            $content = str_replace($match, '#', $content);
                        }
                    } elseif (preg_match('/mailto:(.*?)/', $match)) {

                        $content = str_replace($match, $match, $content);

                    } elseif (substr($match, 0, 1) == "#") {

                        $content = str_replace($match, $match, $content);

                    } else {

                        $trackClick = $lsencrypt
                            ->encrypt(
                                $this->trackingLink . '&ev=click&p=url&url=' . urlencode($match) . '&ec=' . $lsencrypt->encrypt($this->idEmailCampaign)
                            );

                        $trackUrlLink = $this->trackerRoute . "id=" . $trackClick;

                        $content = str_replace(
                            'href="' . $match . '"',
                            'href="' . $trackUrlLink . '"',
                            $content
                        );
                    }
                }
            }

            $trackOpen = $lsencrypt
                ->encrypt(
                    $this->trackingLink . '&ev=open&p=inboxemail&em=' . $this->email->getIdEmail()
                );
            //Adding a fake Image for track the opens
            if($this->trackerRoute){
                $content = str_replace(
                    '</body>',
                    '<img src="' . $this->trackerRoute . "id=" . $trackOpen . '" alt="" width="0" height="0" /></body>',
                    $content);
            }
        }

        $content = $this->addBadgeHtml($content);
        //Creating the final content
        $htmlContent = htmlspecialchars_decode($content);

        return $htmlContent;
    }



    private function replaceLandingPageAndTracking($content,$lsencrypt,$systemController,$match)
    {
        //Create and replace LandingPage Links and adding the Tracking Link
        if ( preg_match_all(
            '/{landingpage}(.*?){landingpage}/',
            $content,
            $matchsLanding)
        ) {

            foreach ($matchsLanding[0] as $matchLanding) {

                $content = str_replace(
                    $match,
                    $matchLanding,
                    $content);

                $idLandingPage = str_replace(
                    '{landingpage}',
                    '',
                    $matchLanding);

                $landingpage = $this
                    ->em
                    ->getRepository('LeadsiusMarketingAutomationBundle:MaLandingPage')
                    ->find($idLandingPage);

                if ($landingpage) {

                    $landingLink = $systemController->generatePublicUrlAction(
                            $landingpage->getIdAccount(),
                            'lp', $idLandingPage,
                            $this->container,
                            $this->container->get('doctrine')) . '&c=' . $lsencrypt->encrypt($this->contact['idContact']) . '&ec=' . $lsencrypt->encrypt($this->idEmailCampaign);

                    $trackClick = $lsencrypt->encrypt($this->trackingLink . '&ev=click&p=landingpage&l=' . $idLandingPage . '&url=' . urlencode($landingLink));

                    $landingPubclicFullLink = $this->trackerRoute . "id=" . $trackClick;

                    $content = str_replace(
                        '{landingpage}' . $idLandingPage . '{landingpage}',
                        $landingPubclicFullLink, $content);

                }
            }

        }

        return $content;
    }


    private function replaceEmailPublicUrlAndTracking($lsencrypt,$systemController,$content)
    {

        $emailPublicLink = $systemController
                ->generatePublicUrlAction(
                    $this->email->getIdAccount(),
                    'email', $this->email->getIdEmail(),
                    $this->container,
                    $this->container->get('doctrine')) . '&c=' . $lsencrypt->encrypt($this->contact['idContact']) . '&ec=' . $lsencrypt->encrypt($this->idEmailCampaign);
        $trackClick = $lsencrypt->encrypt($this->trackingLink . '&ev=click&p=webemail&url=' . urlencode($emailPublicLink));
        $emailPublicFullLink = $this->trackerRoute . "id=" . $trackClick;
        $content = str_replace(
            '%email_public_url%',
            $emailPublicFullLink, $content);

        return $content;
    }

    private function addBadgeHtml($content)
    {
        $badgeTemporal = $this->email->getIdBadge();
        $account = $this->email->getIdAccount();
        $plan = $account->getAccountIdPlan();
        if ($badgeTemporal === null) $badgeTemporal = $this->getDefaultBadge();
        if(!BillingService::isPlanPremium($plan)) {
            $pathBadge = $badgeTemporal->getPath();
            $html = "<table style='margin: 0 auto;text-align: center;'><tr><td>" .
                '<a target="_blank" href="http://leadsius.com/?utm_source=user-email&utm_medium=email"><img style="margin:10% 0 10% 0;" src="' .$pathBadge.'" alt="badge-leadsius" /></a>'.
                "</td></tr></table></body>";
            $content = str_replace(
                '</body>',
                $html,
                $content);
        }
        return $content;
    }

    private function setCustomField($content,$contact = null)
    {
        // Replacing the Contact custom Fields
        if($contact){

            $content = str_replace(
                '%ContactFirstname%',
                $contact['contactFirstname'],
                $content);
            $content = str_replace(
                '%ContactLastname%',
                $contact['contactLastname'],
                $content);
            $content = str_replace(
                '%ContactEmail%',
                $contact['contactEmail'],
                $content);

            // Replacing the Company custom Fields
            if ($contact['idCompany'] === '') {

                $content = str_replace(
                    '%CompanyName%',
                    '',
                    $content);
                $content = str_replace(
                    '%CompanyWebsite%',
                    '',
                    $content);

            } else {

                $content = str_replace(
                    '%CompanyName%',
                    $contact['companyName'],
                    $content);
                $content = str_replace(
                    '%CompanyWebsite%',
                    '<a href="' . $contact['companyWebsite'] . '" target="_blank">' . $contact['companyWebsite'] . '</a>',
                    $content);

            }

        }

        return $content;
    }

    public function getBadge($slugName = null)
    {
        if (null !== $slugName) {
            return $this->em
                ->getRepository("LeadsiusPlatformBundle:PlBadge")
                ->findOneBy(array("slugName" => $slugName));
        }
        return $this->em
            ->getRepository("LeadsiusPlatformBundle:PlBadge")
            ->findOneBy(array("isDefault" => true));
    }

    public function getDefaultBadge()
    {
        return $this
            ->em
            ->getRepository("LeadsiusPlatformBundle:PlBadge")
            ->findOneBy(array("isDefault" => true));
    }

    public function getNamePathBadges()
    {
        $badges = array_map(function($badge) {

            return array(
                "name"  => $badge->getSlugName(),
                "path"  =>   $badge->getPath(),
                "alt"  => $badge->getSlugName()
            );
        }, $this->em->getRepository("LeadsiusPlatformBundle:PlBadge")->findAll());
        return $badges;
    }

    public function editLinkDefault($emailContent)
    {
        $emailWithOutLink = str_replace('<a','<a target="_blank" target="_blank" ',$emailContent);
        $emailWithOutLink = str_replace('href="%unsuscribe%"','',$emailWithOutLink);

        return $emailWithOutLink;
    }
*/
}