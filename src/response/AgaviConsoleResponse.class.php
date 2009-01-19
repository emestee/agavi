<?php

// +---------------------------------------------------------------------------+
// | This file is part of the Agavi package.                                   |
// | Copyright (c) 2005-2009 the Agavi Project.                                |
// |                                                                           |
// | For the full copyright and license information, please view the LICENSE   |
// | file that was distributed with this source code. You can also view the    |
// | LICENSE file online at http://www.agavi.org/LICENSE.txt                   |
// |   vi: set noexpandtab:                                                    |
// |   Local Variables:                                                        |
// |   indent-tabs-mode: t                                                     |
// |   End:                                                                    |
// +---------------------------------------------------------------------------+

/**
 * AgaviConsoleResponse handles command line responses.
 *
 * @package    agavi
 * @subpackage response
 *
 * @author     David Zülke <david.zuelke@bitextender.com>
 * @copyright  Authors
 * @copyright  The Agavi Project
 *
 * @since      1.0.0
 *
 * @version    $Id$
 */
class AgaviConsoleResponse extends AgaviResponse
{
	/**
	 * @var        string The content to send back with this response.
	 */
	protected $content = '';
	
	/**
	 * Import response metadata (nothing in this case) from another response.
	 *
	 * @param      AgaviResponse The other response to import information from.
	 *
	 * @author     David Zülke <david.zuelke@bitextender.com>
	 * @since      1.0.0
	 */
	public function merge(AgaviResponse $otherResponse)
	{
	}
	
	/**
	 * Redirect externally. Not implemented here.
	 *
	 * @param      mixed Where to redirect.
	 *
	 * @throws     BadMethodCallException
	 *
	 * @author     David Zülke <david.zuelke@bitextender.com>
	 * @since      1.0.0
	 */
	public function setRedirect($to)
	{
		throw new BadMethodCallException('Redirects are not implemented for Console.');
	}
	
	/**
	 * Get info about the set redirect. Not implemented here.
	 *
	 * @return     array An assoc array of redirect info, or null if none set.
	 *
	 * @throws     BadMethodCallException
	 *
	 * @author     David Zülke <david.zuelke@bitextender.com>
	 * @since      1.0.0
	 */
	public function getRedirect()
	{
		throw new BadMethodCallException('Redirects are not implemented for Console.');
	}

	/**
	 * Check if a redirect is set. Not implemented here.
	 *
	 * @return     bool true, if a redirect is set, otherwise falsae
	 *
	 * @throws     BadMethodCallException
	 *
	 * @author     David Zülke <david.zuelke@bitextender.com>
	 * @since      1.0.0
	 */
	public function hasRedirect()
	{
		throw new BadMethodCallException('Redirects are not implemented for Console.');
	}

	/**
	 * Clear any set redirect information. Not implemented here.
	 *
	 * @throws     BadMethodCallException
	 *
	 * @author     David Zülke <david.zuelke@bitextender.com>
	 * @since      1.0.0
	 */
	public function clearRedirect()
	{
		throw new BadMethodCallException('Redirects are not implemented for Console.');
	}
	
	/**
	 * Determine whether the content in the response may be modified by appending
	 * or prepending data using string operations. Typically false for streams, 
	 * and for responses like XMLRPC where the content is an array.
	 *
	 * @return     bool If the content can be treated as / changed like a string.
	 *
	 * @author     David Zülke <david.zuelke@bitextender.com>
	 * @since      1.0.0
	 */
	public function isContentMutable()
	{
		return !is_resource($this->content);
	}
	
	/**
	 * Send all response data to the client.
	 *
	 * @author     David Zülke <david.zuelke@bitextender.com>
	 * @since      1.0.0
	 */
	public function send(AgaviOutputType $outputType = null)
	{
		$this->sendContent();
	}
	
	/**
	 * Clear all reponse data.
	 *
	 * @author     David Zülke <david.zuelke@bitextender.com>
	 * @since      1.0.0
	 */
	public function clear()
	{
		$this->clearContent();
	}
	
	/**
	 * Send the content for this response
	 *
	 * @author     David Zülke <david.zuelke@bitextender.com>
	 * @since      1.0.0
	 */
	protected function sendContent()
	{
		$isContentMutable = $this->isContentMutable();
		
		parent::sendContent();
		
		if($isContentMutable && $this->getParameter('append_eol', true)) {
			echo PHP_EOL;
		}
	}
}

?>