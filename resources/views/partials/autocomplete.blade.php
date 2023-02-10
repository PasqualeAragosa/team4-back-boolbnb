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

      const smallAddress = `<small id="helpAddress" class="text-muted"> &ast; Please Enter The Address</small>`

      const address = document.querySelector('.address');
      
      address.insertAdjacentElement('beforeend',searchBoxHTML);
      address.insertAdjacentHTML('beforeend', smallAddress);


      const inputSearchBox = document.querySelector("input.tt-search-box-input");

      inputSearchBox.setAttribute("id", "address"); // add id
      inputSearchBox.setAttribute("name", "address"); // name
      inputSearchBox.setAttribute("required", ''); // add required
</script>
