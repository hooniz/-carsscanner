<?php

namespace App\Modules\System\View;

class View
{
	protected string $title;
	protected array $placeholders = [];

	public function show(string $viewName, array $result = [], bool $showTemplates = true)
	{
		$this->startBuffering();
		if($showTemplates)
		{
			$this->showHeader();
		}
		$this->showContent($viewName, $result);
		if($showTemplates)
		{
			$this->showFooter();
		}
		$html = $this->stopBuffering();
		$this->replacePlaceHolders($html);
		echo $html;
	}

	public function startBuffering()
	{
		ob_start();
	}

	public function showHeader()
	{
		$headerFilePath = $_SERVER['DOCUMENT_ROOT'] . '/app/views/templates/header.php';
		if(file_exists($headerFilePath))
		{
			require_once $headerFilePath;
		}
	}

	public function showContent(string $viewName, array $result)
	{
		require_once $_SERVER['DOCUMENT_ROOT'] . '/app/views/' . $viewName . '.php';
	}

	public function showFooter()
	{
		$footerFilePath = $_SERVER['DOCUMENT_ROOT'] . '/app/views/templates/footer.php';
		if(file_exists($footerFilePath))
		{
			require_once $footerFilePath;
		}
	}

	public function stopBuffering()
	{
		return ob_get_clean();
	}

	public function replacePlaceHolders(&$html)
	{
		if(isset($this->title))
		{
			$html = str_replace('#TITLE#', $this->title, $html);
		}
		foreach ($this->placeholders as $placeholder => $content)
		{
			$html = str_replace("#{$placeholder}#", $content, $html);
		}
	}

	public function setTitle(string $title)
	{
		$this->title = $title;
	}

	public function setPlaceholder(string $key, string $content)
	{
		$this->placeholders[$key] = $content;
	}
}