<?php

namespace Colmenapp\PlataformaBundle\Lib\Servicios;


class ClimaService extends BaseClimaService
{

    public function getClimaActual($lat=null, $long=null)
    {
        return  "http://api.openweathermap.org/data/2.5/weather?q=La_Rioja%2Car&APPID=05a6193e5aceca0e58d419717731fba7&mode=html";
        /*$curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.openweathermap.org/data/2.5/weather?q=La_Rioja%2Car&APPID=05a6193e5aceca0e58d419717731fba7&mode=html",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "postman-token: 1c12da2c-1d27-01e7-0401-8a9e6d35be3e"
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }

        */
    }

    public function getClimaExtendido($lat, $long)
    {

    }




    /**
     * Replace Email Public Url with Tracking Link//Replace Email Public Url with Tracking Link
     *
     * @param $lsencrypt lsencrypt
     * @param $systemController SystemController
     * @param $content string
     * @return string
     */
    /*private function replaceEmailPublicUrlAndTracking($lsencrypt,$systemController,$content)
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
    }*/

    /**
     * @param $content string
     * @return mixed
     */
   /* private function addBadgeHtml($content)
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
    }*/

    /**
     * @param $content string
     * @param $contact PlContact
     * @return string
     */
    /*private function setCustomField($content,$contact = null)
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
    }*/

    /**
     * @param $slugName string
     * @return PlBadge|null
     */
    /*public function getBadge($slugName = null)
    {
        if (null !== $slugName) {
            return $this->em
                ->getRepository("LeadsiusPlatformBundle:PlBadge")
                ->findOneBy(array("slugName" => $slugName));
        }
        return $this->em
            ->getRepository("LeadsiusPlatformBundle:PlBadge")
            ->findOneBy(array("isDefault" => true));
    }*/

    /**
     * @return PlBadge
     */
    /*public function getDefaultBadge()
    {
        return $this
            ->em
            ->getRepository("LeadsiusPlatformBundle:PlBadge")
            ->findOneBy(array("isDefault" => true));
    }*/

    /**
     * Get slugName and path the badges
     *
     * @return array
     */
    /*public function getNamePathBadges()
    {
        $badges = array_map(function($badge) {
            /** @var PlBadge $badge */
       /*     return array(
                "name"  => $badge->getSlugName(),
                "path"  =>   $badge->getPath(),
                "alt"  => $badge->getSlugName()
            );
        }, $this->em->getRepository("LeadsiusPlatformBundle:PlBadge")->findAll());
        return $badges;
    }*/

    /**
     * Edit link for preview
     *
     * @param $emailContent
     * @return string
     */
    /*public function editLinkDefault($emailContent)
    {
        $emailWithOutLink = str_replace('<a','<a target="_blank" target="_blank" ',$emailContent);
        $emailWithOutLink = str_replace('href="%unsuscribe%"','',$emailWithOutLink);

        return $emailWithOutLink;
    }*/

}