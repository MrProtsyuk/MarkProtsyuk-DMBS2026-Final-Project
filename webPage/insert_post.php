<!doctype html>
<html>
  <head>
    <title>Add New Post</title>
    <link rel="stylesheet" href="./styles.css" />
  </head>
  <body>
    <div class="container">
      <h1>Add New Blog Post</h1>
      <form action="insert_post.php" method="post">
        <label for="userid">User ID</label>
        <input
          type="text"
          id="userid"
          name="userid"
          placeholder="Enter your User ID"
          required
        />
        <label for="categoryid">Category ID</label>
        <input
          type="text"
          id="categoryid"
          name="categoryid"
          placeholder="Enter Category ID"
          required
        />
        <label for="title">Title</label>
        <input
          type="text"
          id="title"
          name="title"
          placeholder="Give your post a title"
          required
        />
        <label for="content">Content</label>
        <textarea
          id="content"
          name="content"
          placeholder="Write your post content here..."
          required
        ></textarea>
        <input type="submit" value="Submit" />
      </form>
    </div>
  </body>
</html>
