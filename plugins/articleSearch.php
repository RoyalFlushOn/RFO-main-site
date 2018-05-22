<div class="row" id="srchRow">
    <div class="col-md-offset-2 col-md-6 ">
        <div class="input-group">
            <input type="text" name="srchTxtBx" id="srchTxtBx" class="form-control" placeHolder="Head Line...">
            <span class="input-group-btn">
                <button class="btn btn-default dropdwn-toggle"
                        type="button"
                        data-toggle="dropdown"
                        aria_haspopup="true"
                        id="srchOptDrpDwnBtn"
                        >Headline <span class="caret"></span></button>
                <ul class="dropdown-menu" id="srchOptDrpDwn">
                    <li><a href="#" tabindex="-1">Headline</a></li>
                    <li><a href="#" tabindex="-1">Summary</a></li>
                    <li><a href="#" tabindex="-1">Author</a></li>
                    <li><a href="#" tabindex="-1">Tags</a></li>
                </ul>
                <button type="button" class="btn btn-success" id="srchBtn" name="srchBtn">Search</button>
            </span>
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-offset-2">
        <label for="" id="srchErrLbl" class="control-label"></label>
        </div>
    </div>
    
    
</div>
<div class="row" id="rsltTbl" hidden="True">
    <!-- <label class="label"> Search results.<button type="button" class="close" id="srchClsBtn"><span aria-hidden="true">&times;</span></button></label> -->
    <table class="table">
        <thead>
            <tr class="success">
                <th>Search results</th>
                <th></th>
                <th><button type="button" class="close" id="srchClsBtn"><span aria-hidden="true">&times;</span></button></th>
            </tr>
            <tr>
                <th>Headline</th>
                <th>Author</th>
                <th>Link</th>
            </tr>
        </thead>
        <tbody id="rsltTBdy">
        
        </tbody>
    </table>
</div>

