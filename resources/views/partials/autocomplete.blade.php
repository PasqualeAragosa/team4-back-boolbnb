<script>
      const options = {
        searchOptions: {
          key: "dcEQtI4NS1isWSGpD7hptIGNCBFbNbcC",
          language: "en-GB",
          limit: 5,
        },
        autocompleteOptions: {
          key: "dcEQtI4NS1isWSGpD7hptIGNCBFbNbcC",
          language: "en-GB",
        },
      };
      const ttSearchBox = new tt.plugins.SearchBox(tt.services, options);
      const searchBoxHTML = ttSearchBox.getSearchBoxHTML();

      const address = document.querySelector('.address');
      
      address.insertAdjacentElement('beforeend',searchBoxHTML )


      const inputValue = document.querySelector("input.tt-search-box-input");

      inputValue.setAttribute("id", "address"); // add id
      inputValue.setAttribute("name", "address"); // name
      inputValue.setAttribute("required");
</script>

