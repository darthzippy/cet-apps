class CommentsController < ApplicationController
  
  layout 'application'
  
  before_filter :load_computer, :login_required
  
  def load_computer
    @computer = Computer.find(params[:computer_id])
  end
  
  # GET /comments
  # GET /comments.xml
  def index
    @comments = @computer.comments.find(:all)

    respond_to do |format|
      format.html # index.html.erb
      format.xml  { render :xml => @comments }
    end
  end

  # GET /comments/1
  # GET /comments/1.xml
  def show
    @comment = @computer.comments.find(params[:id])

    respond_to do |format|
      format.html # show.html.erb
      format.xml  { render :xml => @comment }
    end
  end

  # GET /comments/new
  # GET /comments/new.xml
  def new
    @comment = @computer.comments.build

    respond_to do |format|
      format.html # new.html.erb
      format.xml  { render :xml => @comment }
    end
  end

  # GET /comments/1/edit
  def edit
    @comment = @computer.comments.find(params[:id])
    @comment.update_attribute( :updated_by => current_cet_user.display_name )
  end

  # POST /comments
  # POST /comments.xml
  def create
    @comment = @computer.comments.build(params[:comment])
    @comment.update_attributes( :updated_by => current_cet_user.display_name )

    respond_to do |format|
      if @comment.save
        flash[:notice] = 'Comment was successfully created.'
        format.html { redirect_to(@computer, @comment) }
        format.xml  { render :xml => @comment, :status => :created, :location => @comment }
        format.js
      else
        format.html { render :action => "new" }
        format.xml  { render :xml => @comment.errors, :status => :unprocessable_entity }
        format.js do
          render :update do |page|
            page.redirect_to(@computer, @comment)
          end
        end
      end
    end
  end

  # PUT /comments/1
  # PUT /comments/1.xml
  def update
    @comment = @computer.comments.find(params[:id])

    respond_to do |format|
      if @comment.update_attributes(params[:comment])
        flash[:notice] = 'Comment was successfully updated.'
        format.html { redirect_to(@computer, @comment) }
        format.xml  { head :ok }
      else
        format.html { render :action => "edit" }
        format.xml  { render :xml => @comment.errors, :status => :unprocessable_entity }
      end
    end
  end

  # DELETE /comments/1
  # DELETE /comments/1.xml
  def destroy
    @comment = @computer.comments.find(params[:id])
    @comment.destroy

    respond_to do |format|
      format.html { redirect_to(computer_comments_url) }
      format.xml  { head :ok }
      format.js
    end
  end
end
