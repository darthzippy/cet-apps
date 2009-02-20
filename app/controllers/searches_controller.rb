class SearchesController < ApplicationController
  
  layout 'application'
    
  before_filter :login_required
  
  def new
    @search = Search.new
  end
  
  def create
    @search = Search.new(params[:search])
    if @search.save
      flash[:notice] = "Successfully created search."
      redirect_to @search
    else
      render :action => 'new'
    end
  end
  
  def show
    @search = Search.find(params[:id])
  end
end
