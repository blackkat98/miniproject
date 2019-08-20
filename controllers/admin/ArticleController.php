<?php
	require_once('../../models/Article.php');

	class ArticleController
	{
		public function store() {
			$summary = $_POST['summary'];
			$content = $_POST['content'];

			$article = new Article($summary, $content);
			$article->save();

			header('Location: ../../views/admin/articles.php');
		}

		public function update($id) {
			$summary = $_POST['summary'];
			$content = $_POST['content'];

			$con = Connection::getInstance();
			$sql = $con->prepare("UPDATE tblArticle SET tblArticle.summary = ?, tblArticle.content = ? WHERE tblArticle.id = ?");
			$sql->execute([$summary, $content, $id]);

			header('Location: ../../views/admin/articles.php');
		}

		public function destroy($id) {
			$article = new Article();
			$article = $article->find($id);
			$article->delete();

			header('Location: ../../views/admin/articles.php');
		}
	}

	if(isset($_POST['create']))
	{
		$aC = new ArticleController();
		$aC->store();
	}
	if(isset($_POST['edit']))
	{
		$id = $_POST['id'];
		$aC = new ArticleController();
		$aC->update($id);
	}
	if(isset($_POST['delete']))
	{
		$id = $_POST['id'];
		$aC = new ArticleController();
		$aC->destroy($id);
	}